<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'author' => $this->author,
            'published_at' => $this->renderDateFormat($this->published_at, false),
            'libraries' => $this->libraryList(),
            'histories' => $this->historyList()
        ];
    }

    private function renderDateFormat($date, $withTime)
    {
        $format = $withTime ? 'F d, Y h:i:s A' : 'F d, Y';
        return date($format, strtotime($date));
    }

    private function libraryList()
    {
        $libraries = [];

        foreach ($this->libraryBooks as $key => $library) {
            $libraries[] = $library->library->name;
        }
        
        return $libraries;
    }

    private function historyList()
    {
        $histories = [];
        $list = $this->histories()->orderBy('borrowed_at', 'desc')->get();

        foreach ($list as $key => $history) {
            $histories[$key]['borrowed_by'] = $history->user->name;
            $histories[$key]['borrowed_at'] = $this->renderDateFormat($history->borrowed_at, true);
            $histories[$key]['returned_at'] = $history->returned_at ? $this->renderDateFormat($history->returned_at, true) : null;
        }
        
        return $histories;
    }
}
