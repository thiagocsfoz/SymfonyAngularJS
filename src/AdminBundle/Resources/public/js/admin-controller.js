    'use strict';

    /**
     *
     * @param $scope
     * @param $state
     */
    angular.module('Admin')
        .controller('AdminController', function ( $scope, $injector, $state ) {

            /**
             * Injeta os métodos, atributos e seus estados herdados de AbstractCRUDController.
             * @see AbstractCRUDController
             */
            $injector.invoke(AbstractCRUDController, this, {$scope: $scope});

            /*-------------------------------------------------------------------
             * 		 				 	ATTRIBUTES
             *-------------------------------------------------------------------*/
            //----STATES
            $scope.INDEX_STATE = "admin.index";

            //----FORM MODEL
            /**
             * Contém o estados dos filtros da tela
             * Contém estado da paginação inicial contendo sorting
             */
            $scope.model = {};


            /*-------------------------------------------------------------------
             * 		 				  POST CONSTRUCT
             *-------------------------------------------------------------------*/
            /**
             * Handler que escuta as mudanças de URLs pertecentes ao estado da tela.
             * Ex.: list, add, detail, edit
             *
             * Toda vez que ocorre uma mudança de URL se via botão, troca de URL manual, ou ainda
             * ao avançar e voltar do browser, este evento é chamado.
             *
             */
            $scope.initialize = function () {

                switch ($state.current.name) {
                    case $scope.INDEX_STATE:
                    {
                        $scope.changeToIndex();
                        break;
                    }
                    default :
                    {
                        $state.go($scope.INDEX_STATE);
                    }
                }
            };

            /*-------------------------------------------------------------------
             * 		 				 	  HANDLERS
             *-------------------------------------------------------------------*/

            $scope.changeToIndex = function() {
            
            };

            $scope.changeToDetail = function () {

            }

    });