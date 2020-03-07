<?php


namespace App\Repositories;
use App\Order as Model;
use App\OrderDetail;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\Node\Expr\AssignOp\Mod;

class OrderRepository extends BaseRepository
{

    /**
     * @var Collection
     */
    protected $model = null;

    /**
     * @param Builder $model
     * @return Builder
     */
    protected function withRelationships(Builder $model)
    {
        return $model->with('products')
            ->with('products.category')
            ->with('user')
            ->with('user.detail')
            ->with('details')
            ->with('payment')
            ->with('shipping');
    }

    /**
     * @return Collection
     */
    public function getAllWithRelationships()
    {
        return $this->model = $this->withRelationships(Model::query())->get();
    }

    /**
     * @param $id
     * @return Collection
     */
    public function getOrderWithRelationships($id)
    {
//        dd($this->withRelationships(Model::query())->where('id', $id)->get(), collect([$this->withRelationships(Model::query())->findOrFail($id)]));
//        dd(collect([$this->withRelationships(Model::query())->findOrFail($id)]));
        return $this->model = $this->withRelationships(Model::query())->where('id', $id)->get();
    }

    /**
     * @return Collection
     */
    public function getOrderStatus()
    {
        $this->model->map(function ($order) {
            return $order->detail_status = $order->details->sortByDesc('date_added')->first()->status;
        });
        return $this->model;
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id)
    {
        return Model::findOrFail($id);
    }

    /**
     * @param Model $order
     * @param $data
     * @return bool
     */
    public function update(Model $order, $data)
    {
        return $order->update($data);
    }

    /**
     * @param Model $order
     * @return bool|null
     * @throws Exception
     */
    public function delete(Model $order)
    {
        return $order->delete();
    }

    /**
     * @param Model $order
     * @param $input
     */
    public function updateProducts(Model $order, $input)
    {
        $order->products()->sync($input);
    }

    public function setOrderStatus(Model $order, array $input)
    {
        $order->details()->save(new OrderDetail($input));
    }
}
