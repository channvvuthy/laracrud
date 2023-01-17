# LARACRUD UI Generator
## Introduction 
### The package follows Laravel MVC and it has 4 paths
- Controller
- View
- Model
- Helper

# Installation and configuration 
Just clone the repository and copy the example.env to .env and configure with your own environment and run php artisan migrate, 
If missing some function from helper, please run compose dump-autoload

# How to generate list UI
To generate list view your controller needs to extend or inherit from LaraCRUDController and add some properties with constructor
```php
class CategoryController extends LaraCRUDController{
    /**
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        parent::__construct();
        $this->model = $category;
        $this->limit = 10;
        $this->title = "Category List";

        $this->head = [
            array('field' => 'name', 'title' => 'Name'),
            array('field' => 'photo', 'title' => 'Photo'),
            array('field' => 'description', 'title' => 'Description'),
            array('field' => 'status', 'title' => 'Status'),
        ];
    }
}
```

After you extend the base controller and add some properties with constructor ready, you need to add function getIndex to render the view
```php
    /**
     * @return mixed
     */
    public function getIndex(): mixed
    {
        $this->result = $this->paginate();
        $this->init();
        return view('admincrud.index', ['data' => $this->data]);
    }
```
After that your view will look like the screenshot

![LARACRUD](/public/images/screenshot/list.png?raw=true "LARACRUD")



# How to generate form create
Will update soon...

# How to generate form edit 
Will update soon..

# How to delete item
Will update soon...

# How to custom view
Will update soon...

![LARACRUD](/public/images/screenshot/Screenshot.png?raw=true "LARACRUD")
