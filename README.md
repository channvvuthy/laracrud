# LARACRUD UI Generator
## Introduction 
### The package follows Laravel MVC and it has 4 paths
- Controller
- View
- Model
- Helper

# Installation and configuration 
Just clone the repository and copy the .env.example to .env and configure with your own environment and run php artisan migrate, 
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
To create a form, you should inherit LaraCRUDController and the optional getAdd function and properties 
```php
class CategoryController extends LaraCRUDController{
    /**
     * @param Category $category
     */
    public function __construct(Category $category)
    {
         $this->form = [
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required|min:10'),
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'file', 'accept' => 'image/*'),
            array('field' => 'description', 'title' => 'Description', 'type' => 'text'),
            array('field' => 'status', 'title' => 'Status', 'type' => 'status'),
        ];
    }
    
    /**
     * @return View|Factory|Application
    */
    public function getAdd(): View|Factory|Application
    {
        $this->title = "Add new Category";
        $this->data['form'] = $this->form;
        $this->data['back'] = "Category";
        $this->init();
        return view('admincrud.add', ['data' => $this->data]);
    }
}
```

After that your form will look like the screenshot

![LARACRUD](/public/images/screenshot/add.png?raw=true "LARACRUD")

- **Form Input Type**
    - [checkbox](./form-checkbox.md)
    - [text](./form-text.md)
    - [select](./form-text.md)
    - [select2](./form-text.md)
    - [textarea](./form-text.md)
    - [image](./form-text.md)
    - [upload](./form-text.md)
    - [gender](./form-text.md)
    - [status](./form-text.md)
    - [date](./form-text.md)
    - [hidden](./form-text.md)
    - [password](./form-text.md)
    - [email](./form-text.md)
    - [datetime](./form-text.md)
    - [time](./form-text.md)
    - [radio](./form-text.md)

Will update more...

# How to generate form edit 
Edit form, nothing to be implemented it will generate the same form create.

# How to delete item
Will update soon...

# How to custom view
Will update soon...



![LARACRUD](/public/images/screenshot/Screenshot.png?raw=true "LARACRUD")
