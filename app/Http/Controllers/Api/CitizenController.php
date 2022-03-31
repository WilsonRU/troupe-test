<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\CitizenRepositoryInterface;

class CitizenController extends Controller
{
    protected $repository;

    public function __construct(CitizenRepositoryInterface $repository){
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            $this->repository->findAll(), 200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $json = json_decode($request->getContent())[0];

            $endereco = json_decode(file_get_contents("https://viacep.com.br/ws/{$json->cep}/json/"));


            if (!empty($this->repository->findByCpf($json->cpf))){
                $citizen = $this->repository->create(
                    array_merge((array)$json, ['logradouro' => $endereco->logradouro, 'bairro' => $endereco->bairro, 'cidade' => $endereco->localidade, 'uf' => $endereco->uf])
                );
    
                return response()->json(
                    ['message' => 'Successfully created', 'data' => $citizen], 201
                );
            } else {
                return response()->json(['error' => 'CPF Existing'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 406);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string $cpf
     * @return \Illuminate\Http\Response
     */
    public function show($cpf){
        return response()->json(
            $this->repository->findByCpf($cpf), 200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $json = json_decode($request->getContent())[0];

            $endereco = json_decode(file_get_contents("https://viacep.com.br/ws/{$json->cep}/json/"));

            $this->repository->updateByCpf(
                $json->cpf,
                array_merge((array)$json, ['logradouro' => $endereco->logradouro, 'bairro' => $endereco->bairro, 'cidade' => $endereco->localidade, 'uf' => $endereco->uf])
            );

            return response()->json(
                ['message' => 'Successfully updated'], 200
            );
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 406);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $this->repository->delete($id);

            return response()->json(
                ['message' => 'Successfully deleted'], 202
            );
        } catch (\Exception $e){
            return response()->json(
                ['erro' => $e->getMessage()], 406
            );
        }
    }
}
