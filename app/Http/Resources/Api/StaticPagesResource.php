<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class StaticPagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->slug == 'about-us') {
            $title = __('local.about_app');
        } elseif ($this->slug == 'privacy-policy') {
            $title = __('local.privacy_app');
        } elseif ($this->slug == 'user-agreement') {
            $title = __('local.terms_app');
        } elseif ($this->slug == 'help-center') {
            $title = __('local.help_app');
        }
        return [
            'id'        => $this->id,
            'title'     => $title,
            'desc'      => $this->content,
        ];
    }
}
