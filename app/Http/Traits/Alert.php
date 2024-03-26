<?php

namespace App\Http\Traits;

trait Alert
{
    public function message($type, $message, $title = null)
    {
        return $this->dispatchBrowserEvent('alert', [
            'type' => $type,
            'message' => $message,
            'title' => $title]
        );
    }

    public function alert($type, $message, $title = null) {
        if($title) {
            session()->flash('title', $title);
        }
        session()->flash('type', $type);
        session()->flash('message', $message);
    }
}
