<?php
class ControllerModuleFriendlyUrls extends Controller
{
    
    public function index()
    {
        $data = $this->language->load("module/friendly_urls");
        
        $this->document->setTitle($this->language->get("heading_title"));
        
        $data["token"] = $this->session->data["token"];
        
        $data["header"] = $this->load->controller("common/header");
        $data["column_left"] = $this->load->controller("common/column_left");
        $data["footer"] = $this->load->controller("common/footer");
        
        $this->response->setOutput($this->load->view("module/friendly_urls.tpl", $data));
    }
    
    public function category()
    {
        $this->language->load("module/friendly_urls");
        
        $this->load->model("module/friendly_urls");
        
        $categories = $this->model_module_friendly_urls->getCategories();
        
        $json = array();
        
        foreach($categories as $category) {
            if ($category["query"] == '') {
                try {
                    $this->model_module_friendly_urls->addUrl($category['category_id'], "category", $this->slugify($category['name']));
                    
                    $json['success'][] = sprintf($this->language->get("text_url_added"), $this->url->link("catalog/category", "token=" . $this->session->data["token"], true), $category["name"]);
                } catch (InvalidArgumentException $e) {
                    $json['error'] = $e->getMessage();
                }
            }
            else {
                $json['success'][] = sprintf($this->language->get("text_url_exist"), $this->url->link("catalog/category", "token=" . $this->session->data["token"], true), $category["name"]);
            }
        }
        
        $this->response->addHeader("Content-Type: application/json");
        $this->response->setOutput(json_encode($json));
    }
    
    public function information()
    {
        $this->language->load("module/friendly_urls");
        
        $this->load->model("module/friendly_urls");
        
        $informations = $this->model_module_friendly_urls->getInformations();
        
        $json = array();
        
        foreach($informations as $information) {
            if ($information["query"] == '') {
                try {
                    $this->model_module_friendly_urls->addUrl($information['information_id'], "information", $this->slugify($information['name']));
                    
                    $json['success'][] = sprintf($this->language->get("text_url_added"), $this->url->link("catalog/information", "token=" . $this->session->data["token"], true), $information["name"]);
                } catch (InvalidArgumentException $e) {
                    $json['error'] = $e->getMessage();
                }
            }
            else {
                $json['success'][] = sprintf($this->language->get("text_url_exist"), $this->url->link("catalog/information", "token=" . $this->session->data["token"], true), $information["name"]);
            }
        }
        
        $this->response->addHeader("Content-Type: application/json");
        $this->response->setOutput(json_encode($json));
    }
    
    public function manufacturer()
    {
        $this->language->load("module/friendly_urls");
        
        $this->load->model("module/friendly_urls");
        
        $manufacturers = $this->model_module_friendly_urls->getManufacturers();
        
        $json = array();
        
        foreach($manufacturers as $manufacturer) {
            if ($manufacturer["keyword"] == '') {
                try {
                    $this->model_module_friendly_urls->addUrl($manufacturer['manufacturer_id'], "manufacturer", $this->slugify($manufacturer['name']));
                    
                    $json['success'][] = sprintf($this->language->get("text_url_added"), $this->url->link("catalog/manufacturer", "token=" . $this->session->data["token"], true), $manufacturer["name"]);
                } catch (InvalidArgumentException $e) {
                    $json['error'] = $e->getMessage();
                }
            }
            else {
                $json['success'][] = sprintf($this->language->get("text_url_exist"), $this->url->link("catalog/manufacturer", "token=" . $this->session->data["token"], true), $manufacturer["name"]);
            }
        }
        
        $this->response->addHeader("Content-Type: application/json");
        $this->response->setOutput(json_encode($json));
    }
    
    public function product()
    {
        $this->language->load("module/friendly_urls");
        
        $this->load->model("module/friendly_urls");
        
        $products = $this->model_module_friendly_urls->getProducts();
        
        $json = array();
        
        foreach($products as $product) {
            if ( $product["keyword"] == '') {
                try {
                    $this->model_module_friendly_urls->addUrl($product['product_id'], "product", $this->slugify($product['name']));
                    
                    $json['success'][] = sprintf($this->language->get("text_url_added"), $this->url->link("catalog/product", "token=" . $this->session->data["token"], true), $product["name"]);
                } catch (InvalidArgumentException $e) {
                    $json['error'] = $e->getMessage();
                }
            }
            else {
                $json['success'][] = sprintf($this->language->get("text_url_exist"), $this->url->link("catalog/product", "token=" . $this->session->data["token"], true), $product["name"]);
            }
        }
        
        $this->response->addHeader("Content-Type: application/json");
        $this->response->setOutput(json_encode($json));
    }
    
    /**
        Link: http://stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string
     */
    private function slugify($text)
    { 
        // decode html
        $text = htmlspecialchars_decode($text);

        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        //$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = $this->translit($text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
        {
        return 'n-a';
        }

        return $text;
    }

    private function translit($string) {
        $table = array(
            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',
            'Г' => 'G',
            'Д' => 'D',
            'Е' => 'E',
            'Ё' => 'YO',
            'Ж' => 'ZH',
            'З' => 'Z',
            'И' => 'I',
            'Й' => 'J',
            'К' => 'K',
            'Л' => 'L',
            'М' => 'M',
            'Н' => 'N',
            'О' => 'O',
            'П' => 'P',
            'Р' => 'R',
            'С' => 'S',
            'Т' => 'T',
            'У' => 'U',
            'Ф' => 'F',
            'Х' => 'H',
            'Ц' => 'C',
            'Ч' => 'CH',
            'Ш' => 'SH',
            'Щ' => 'CSH',
            'Ь' => '',
            'Ы' => 'Y',
            'Ъ' => '',
            'Э' => 'E',
            'Ю' => 'YU',
            'Я' => 'YA',
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'yo',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'j',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'csh',
            'ь' => '',
            'ы' => 'y',
            'ъ' => '',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya'
        );
        $output = str_replace(array_keys($table), array_values($table), $string);
        $replaces = array(
                    '.' => '',
                    ',' => '',
                    ' ' => '-',
                    '?' => '',
                    '!' => '',
                    ':' => '',
                    ';' => '',
                    "/" => '-',
                    "\\" => '-',
                    '&' => '',
                    '"' => '',
                    "'" => '',
                    '#' => ''
                    );
        $output = str_replace(array_keys($replaces), array_values($replaces), $output);
        return $output;
    }
}