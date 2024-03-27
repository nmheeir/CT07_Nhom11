<?
class BaseController {
    const VIEW_FOLDER_NAME = "../CT07_Nhom11/mvc/views/";
    const MODEL_FOLDER_NAME = "../CT07_Nhom11/mvc/models/";

    protected function loadView($path, array $data = []) {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        require(self::VIEW_FOLDER_NAME . str_replace('.', '/', $path) . '.php');
    }

    protected function loadModel($path)
    {
        require(self::MODEL_FOLDER_NAME . str_replace('.', '/', $path) . '.php');
    }
}