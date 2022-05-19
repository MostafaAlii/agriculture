<?php
namespace  App\Http\Interfaces\Admin;
interface SubscribeInterface {
    public function data($request);
    public function destroy($id);
    public function bulkDelete($ids);
    // public function sendMails();
}
