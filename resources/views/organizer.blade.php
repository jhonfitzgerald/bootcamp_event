<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Event App</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('js/angular/plugin/blockUI/angular-block-ui.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/custom_backend.css')}}">
        <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    </head>
    <body ng-app="app">
        <div class="position-ref full-height">
            <div class="content" ng-controller="organizerController">
                <div class="card">
                    <div class="card-header center" >
                        <div class="row">
                            <div class="col-md-12">
                                <h5><strong>Lista de Organizadores</strong></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" class="form-control" ng-model="filterPager.filter" ng-change="search(filterPager.filter)" placeholder="Ingrese Texto a Buscar!">
                                    <div class="input-group-append" style="padding-right: 5px;">
                                        <span class="input-group-text" ><i class="fa fa-search"></i></span>
                                    </div>
                                    <span class="input-group-append" style="padding-right: 5px;">
                                        <button class="btn btn-success " ng-click="select(undefined,'save')" onclick='showModal("#viewNewEdit")' title="Agregar Nuevo!">Nuevo</button>
                                    </span>
                                    <span class="input-group-append" style="padding-right: 5px;">
                                        <button class="btn btn-primary " ng-click="getAllItems()" title="Actualizar Lista!">Actualizar</i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12 col-md-offset-4" ng-show="page.lisPage.length">
                                                    <div class="col-md-8" style="text-align: center;margin: 5px auto;">
                                                        <center class="col-md-12" style="display: ruby-text-container;">
                                                            <ul uib-pagination total-items="pager.total" ng-model="pager.currentPage" ng-change="changePageCustom(pager.currentPage)"
                                                                max-size="4" boundary-links="true" style="padding: 0px; margin: 0px;"
                                                                rotate="false" num-pages="pager.numberPage" items-per-page="pager.pageSize"></ul>
                                                        </center>
                                                    </div>
                                                </div>
                                                <div ng-show="page.lisPage.length<=0" class="pull-left" style="padding-left: 10px;padding-right: 10px"><p ng-bind-html="allowHtml(message)"></p></div>
                                                <table class="table table-hover table-sm">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col" class="center middle" style="width: 60%;">Nombre</th>
                                                            <th scope="col" class="center middle">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat='item in page.lisPage | filter:filterPager.filter | startFrom:pager.currentPage==0?pager.currentPage*pager.pageSize:(pager.currentPage*pager.pageSize)-pager.pageSize | limitTo:pager.pageSize '>
                                                            <td class="middle">@{{item.name}}</td>
                                                            <td style="text-align: center;vertical-align: middle;">
                                                                <button title='Editar' class='btn btn-primary btn-sm' ng-click='select(item,"edit")' onclick="showModal('#viewNewEdit')">Editar</button>
                                                                <button title='Eliminar' class='btn btn-danger btn-sm' ng-click='select(item,"delete")' onclick="showModal('#showQuestion')">Eliminar</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="viewNewEdit">
                    <form novalidate name="form">
                        <div class="modal-dialog modal-lg modal-question">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title font-bold modal-title-h"><strong>@{{type=='view'?'VER':(type=='edit')?'EDITAR':'REGISTRAR'}}</strong></h4>
                                    <div class="pull-right">
                                        <button type="button" class="close" onclick="hideModal()" ng-click="cancelModal()">
                                            <i class="fa fa-close"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-2 row-input br right middle">
                                            <label>Nombre:</label>
                                        </div>
                                        <div class="col-md-10 br row-input">
                                            <input type="text" class="form-control" ng-model="objectSelected.name" placeholder="Nombre" ng-disabled="type=='view'" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" ng-show="type!='view'">
                                    <button class="btn btn-danger font-bold" ng-click="cancel()" onclick="hideModal()"><i class="fa fa-close"></i> Cancelar</button>
                                    <button class="btn btn-success font-bold" ng-click='validateForm(form)'><i class="fa fa-save"></i> Guardar</button>
                                </div>
                                <div class="modal-footer" ng-show="type=='view'">
                                    <button class="btn btn-primary dim btnclose font-bold" onclick="hideModal()">
                                        <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Aceptar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal fade" id="showQuestion">
                    <div class="modal-dialog modal-md modal-question">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title font-bold modal-title-h">Atención</h4>
                                <div class="pull-right">
                                    <button type="button" class="close" data-dismiss="modal">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="modal-body modal-text-center">
                                ¿Seguro que desea Realizar la Acción Solicitada?
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary dim btnclose font-bold" onclick="hideModal()" ng-click='action()'>
                                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Aceptar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/backend.js') }}"></script>
        <script src="{{ asset('js/angular.min.js') }}"></script>
        <script src="{{ asset('js/angular/angular-animate.min.js') }}"></script>
        <script src="{{ asset('js/angular/angular-resource.min.js') }}"></script>
        <script src="{{ asset('js/angular/ui-bootstrap-tpls.min.js') }}"></script>
        <script src="{{ asset('js/angular/angular-sanitize.min.js') }}"></script>
        <script src="{{ asset('js/angular/ui-bootstrap-fontawesome.min.js') }}"></script>
        <script src="{{ asset('js/angular/plugin/blockUI/angular-block-ui.min.js') }}"></script>
        <script src="{{ asset('js/angular/i18n/angular-locale_es.js') }}"></script>
        <script src="{{ asset('js/angular/backapp.js') }}"></script>
        <script src="{{ asset('js/angular/controller/organizerController.js') }}"></script>
        <script src="{{ asset('js/angular/services/organizerService.js') }}"></script>
        <script src="{{ asset('js/bootbox.js') }}"></script>
        <script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
    </body>
</html>
