<section class="adicionar container w-100 h-100 p-10 mt-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">

                    <h3 class="h6 mb-4">Cadastro do produto</h3>

                    <div class="row">
                        <div class="col-lg-7">
                            <div class="mb-3">
                                <label class="form-label">Nome Do produto</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">Codigo do Produto</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-7">
                            <div class="mb-3">
                                <label for="textarea1" class="form-label">Digite a descrição do produto</label>
                                <textarea id="textarea1" class="form-control" rows="7"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row d-flex flex-column justify-content-between h-100">
                                <div class="mb-3">
                                    <label class="form-label">Preço Custo R$</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <input type="number" class="form-control d-flex w-50" placeholder="% Lucro">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Preço R$</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 d-flex flex-column justify-content-between">
            <div class="row">
                <div class="card mb-4">
                    <div class="card-body">
                        <label class="form-label">Digite o Link</label>
                        <input type="text" class="form-control mb-2">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card mb-4">
                    <div class="card-body">
                        <label class="form-label">Numero de parcelas</label>
                        <input type="number" class="form-control mb-2" max="24">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card mb-4">
                    <div class="card-body">
                        <label class="form-label">Porentagem de Desconto</label>
                        <input type="number" class="form-control mb-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>