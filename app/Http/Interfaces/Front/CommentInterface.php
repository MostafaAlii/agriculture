<?php
namespace App\Http\Interfaces\Front;
interface CommentInterface {
    public function store($blog,$request);
    public function destroy($comment);
}