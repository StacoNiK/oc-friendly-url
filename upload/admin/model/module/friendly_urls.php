<?php

class ModelModuleFriendlyUrls extends Model
{
    public function getProducts()
    {
        $query = $this->db->query("SELECT p.product_id, pd.name, ua.query, ua.keyword FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "url_alias ua ON (ua.`query` = CONCAT(\"product_id=\", p.product_id))");
        
        return $query->rows;
    }
    
    public function getCategories()
    {
        $query = $this->db->query("SELECT c.category_id, cd.name, ua.query, ua.keyword FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "url_alias ua ON (ua.`query` = CONCAT(\"category_id=\", c.category_id))");
        
        return $query->rows;
    }
    
    public function getInformations()
    {
        $query = $this->db->query("SELECT i.information_id, id.title AS name, ua.query, ua.keyword FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "url_alias ua ON (ua.`query` = CONCAT(\"information_id=\", i.information_id))");
        
        return $query->rows;
    }
    
    public function getManufacturers()
    {
        $query = $this->db->query("SELECT m.manufacturer_id, m.name, ua.query, ua.keyword FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "url_alias ua ON (ua.`query` = CONCAT(\"manufacturer_id=\", m.manufacturer_id))");
        
        return $query->rows;
    }
    
    public function addUrl($id, $type, $url)
    {
        
        switch($type)
        {
            case "category":
                $query = "category_id=" . (int)$id;
            break;
            
            case "information":
                $query = "information_id=" . (int)$id;
            break;
            
            case "manufacturer":
                $query = "manufacturer_id=" . (int)$id;
            break;
            
            case "product":
                $query = "product_id=" . (int)$id;
            break;
            
            default:
                $query = false;
            break;
        }
        
        if ( $query !== false ) {
            $result = $this->db->query("SELECT * FROM ". DB_PREFIX . "url_alias WHERE query = '".$query."'");
            if (count($result->rows) < 1) {
                $this->db->query("INSERT INTO `" . DB_PREFIX . "url_alias` SET `query` = \"" . $this->db->escape($query) . "\", `keyword` = \"" . $this->db->escape($url) . "\"");
            } else {
                 $this->db->query("UPDATE `" . DB_PREFIX . "url_alias` SET `keyword` = \"" . $this->db->escape($url) . "\" WHERE `query` = \"" . $this->db->escape($query) . "\"");               
            }
            return true;
        }
        else {
            throw new InvalidArgumentException("The type \"{$type}\" is invalid.");
        }
    }
}