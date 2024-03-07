<?
class WelcomeController extends BaseController {
    public function landing() {
        $this->loadView("frontend.landing.landing");
    }
    public function index() {
        if(checkLogin()) {
            header("Location: User/home");
        }
        else {
            $this->loadView("frontend.landing.landing");
        }
    }
}