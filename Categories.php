<?php

class Categories
{
    /**
     * @var $priceCodes array
     */
    protected $priceCodes = array();

    /**
     * @var $categories array
     */
    protected $categories = array();

    /**
     * @var array
     */
    public $category = array();

    public $errors = array();

    public function __construct()
    {
        if (empty($this->categories)) {
            $this->listCategories();
        }

        if (empty($this->priceCodes)) {
            $this->listPriceCodes();
        }

    }

    /**
     * Returns an array object containing all categories.
     * If the categories object is empty, it populates it with default categories and price codes.
     * @return array
     */
    public function listCategories()
    {
        /**
         * The $defaultCategories array contains records for each category including name and price code
         * @var $defaultCategories array
         */
        $defaultCategories = array(
            array(
                'name' => 'REGULAR',
                'price_code' => 0
            ),
            array(
                'name' => 'NEW_RELEASE',
                'price_code' => 1
            ),
            array(
                'name' => 'CHILDRENS',
                'price_code' => 2
            )
        );

        if (empty($this->categories)) {
            $this->categories = $defaultCategories;
        }

        return $this->categories;
    }

    /**
     * Returns an array object containing all price codes.
     * If the price codes object is empty, it populates it with default price codes.
     * @return array
     */
    public function listPriceCodes()
    {
        $defaultPriceCodes = array(0, 1, 2, 3, 4, 5);

        if (empty($this->priceCodes)) {
            $this->priceCodes = $defaultPriceCodes;
        }

        return $this->priceCodes;
    }

    /**
     * @param $name
     * @return array|string
     */
    public function getCategory($name)
    {
        // Simple loop returns the last match.
        // Could be expanded to assume there may be more than one match, etc.
        // Could also expand the project to define an individual category as its own object.
        foreach ($this->categories as $category) {
            if ($category['name'] == $name) {
                $this->category = $category;
            }
        }

        if(empty($this->category)) {
            array_push($this->errors, 'This category does not yet exist.');
            return $this->errors;
        }

        return $this->category;
    }

    public function addCategory($name, $priceCode)
    {
        if (!in_array($priceCode, $this->priceCodes)) {
            array_push($this->errors, 'Price code does not exist.');
            return $this->errors;
        }

        array_push($this->categories, array($name, $priceCode));

        // Return the updated list of categories
        return $this->categories;
    }

    public function updateCategory($name, $priceCode)
    {
        if (!in_array($priceCode, array_values($this->priceCodes))) {
            array_push($this->errors, 'Price code does not exist.');
            return $this->errors;
        }

        foreach ($this->categories as $category) {
            if ($category['name'] == $name) {
                $category['name'] = $name;
                $category['price_code'] = $priceCode;
            }
        }

        return $this->categories;
    }

    public function removeCategory($name)
    {
        foreach ($this->categories as $category) {
            if ($category['name'] == $name) {
                unset($category);
            }
        }

        return $this->categories;
    }
}