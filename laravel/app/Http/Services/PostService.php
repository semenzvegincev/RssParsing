<?php

namespace App\Http\Services;

use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostService
{
    /**
     * @param $url
     * @return array
     */
    public function parseRss($url): array
    {
        $xml = simplexml_load_file($url);
        $data = [];
        foreach ($xml->channel->item as $item) {
            $itemInfo = [
                'title' => (string)$item->title,
                'description' => (string)$item->description,
                'content' => str_replace("\n", '', (string)$item->children('content', true)),
                'author' => (string)$item->author,
                'pubDate' => (string)$item->pubDate,
                'thumbnailUrl' => (string)$item->children('media', true)->thumbnail->attributes(),
                'link' => (string)$item->link,
                'category' => (string)$item->category,
            ];
            $data[] = $itemInfo;
        }
        return $data;
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function search($request): JsonResponse
    {
        $posts = Post::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $posts->where('title', 'ilike', '%' . $searchTerm . '%')
                ->orWhere('description', 'ilike', '%' . $searchTerm . '%');
        }

        $results = $posts->paginate(2);

        if ($results->isEmpty()) {
            return response()->json(['message' => 'We did not find anything by your request. Try again.'], 404);
        }

        return response()->json($results, 200);
    }


}

