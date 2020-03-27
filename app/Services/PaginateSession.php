<?php


namespace App\Services;


use Illuminate\Http\Request;

class PaginateSession
{
    private $limit;

    public function __construct(Request $request)
    {
        if ($request->has('limit') ){
            if ($request->input('limit') < 1){
                $this->remove();
            }else{
                $this->put($request->input('limit'));
            }
        }
        $this->update();
    }

    private function put($limit)
    {
        $this->limit = $limit;
        session()->put('limit', $limit);
    }

    private function remove()
    {
        $this->limit = null;
        session()->remove('limit');
    }

    private function update()
    {
        if(session()->has('limit')){
            $this->limit = session()->get('limit');
        }else{
            $this->limit = 15;
        }
    }

    /**
     * @return integer
     */
    public function getLimit():int
    {
        return $this->limit;
    }
}
