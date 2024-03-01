<?
class WelcomeController extends BaseController {
    public function index() {
        if(checkLogin()) {
            header("Location: User/home");
        }
        else {
            header("Location: Authenciation/login");
        }
    }
}