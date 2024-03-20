<?php

namespace App\Http\Controllers\admin;

use App\Models\Paypal;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;


class PayPalController extends LaraCRUDController
{
    /**
     * @param Paypal $paypal
     */
    public function __construct(Paypal $paypal)
    {
        parent::__construct();

        $this->model = $paypal;
        $this->limit = 10;
        $this->title = "Paypal List";

        $this->head = [
            array('field' => 'client_id', 'title' => 'Client ID'),
            array('field' => 'client_secret', 'title' => 'Client Secret'),
            array('field' => 'slug', 'title' => 'Slug'),
        ];

        $this->form = [
            array('field' => 'client_id', 'title' => 'Client ID', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'client_secret', 'title' => 'Client Secret', 'type' => 'text', 'required' => true, 'validated' => 'required'),
        ];
    }

    /**
     * @return Application|Factory|View
     */
    public function getIndex(): View|Factory|Application
    {
        $this->data['result'] = $this->paginate();
        $this->init();
        return view('admin.index', ['data' => $this->data]);
    }

    /**
     * @return Factory|View|Application
     */
    public function getAdd(): Factory|View|Application
    {
        $this->data['form'] = $this->form;
        $this->init();
        return view('admin.add', ['data' => $this->data]);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getEdit($id): mixed
    {
        $this->data['back'] = "user";
        $this->data['form'] = $this->form;
        $this->addRelation($this->data['form']);
        return parent::getEdit($id); // TODO: Change the autogenerated stub
    }


    /**
     * @param $id
     * @return mixed
     */
    public function detail($id): mixed
    {
        $this->data['find'] = $this->model->findOrFail($id);
        $this->data['title'] = 'Detail of ' . $this->model->moduleName;
        $this->data['back'] = $this->model->moduleName;
        $this->init();
        return view('admin.detail', ['data' => $this->data]);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function postAdd(Request $request): Redirector|RedirectResponse|Application
    {
        $redirectUrl = $request->get('save');
        $fields = $request->except('_token', 'save');
        $request->validate($this->validationForm());

        $this->updateEnvironment($fields);
        $this->model->create($fields);

        return redirect($redirectUrl)->with('message', 'The data has been added');
    }

    /**
     * Update the environment file with the provided client ID and client secret.
     *
     * @param array $fields The array containing client ID and client secret
     */
    public function updateEnvironment($fields = [])
    {
        $envFile = base_path('.env');

        $currentEnv = file_get_contents($envFile);

        $newClientId = $fields['client_id'];
        $newClientSecret = $fields['client_secret'];

        $currentEnv = preg_replace('/PAYPAL_SANDBOX_CLIENT_ID=.*/', 'PAYPAL_SANDBOX_CLIENT_ID=' . $newClientId, $currentEnv);
        $currentEnv = preg_replace('/PAYPAL_SANDBOX_CLIENT_SECRET=.*/', 'PAYPAL_SANDBOX_CLIENT_SECRET=' . $newClientSecret, $currentEnv);

        file_put_contents($envFile, $currentEnv);
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request): mixed
    {
        $redirectUrl = $request->get('save');
        $fields = $request->except('_token', 'save');

        $request->validate($this->validationForm());

        $this->updateEnvironment($fields);
        $this->model->where($this->pk, $request->get('id'))->update($fields);

        return redirect($redirectUrl)->with('message', 'The data has been updated');
    }
}