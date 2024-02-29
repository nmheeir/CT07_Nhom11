<?
class WelcomeController extends BaseController {
    public function index() {
        if(checkLogin()) {
            header("Location: Order/userOrderList");
        }
        else {
            header("Location: Authenciation/login");
        }
    }
}