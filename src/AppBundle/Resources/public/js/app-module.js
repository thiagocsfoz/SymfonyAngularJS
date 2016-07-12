(function (window, angular, undefined) {
    'use strict';

    //Start the AngularJS
    var myapp = angular.module('App', ['ui.router']);

    myapp.config(function ($stateProvider, $urlRouterProvider) {

        //-------
        //URL Router
        //-------

        //HOME
        $urlRouterProvider.otherwise("/");

        $stateProvider
        .state('portal', {
            url: '/',
            template: '<div ui-view/>',
            controller: 'AppController as appController'
        })
        .state('portal.index', {
            url: '',
            templateUrl: '../bundles/app/templates/index.html'
        })
        .state('portal.detail', {
            url: 'detail',
            templateUrl: '../bundles/app/templates/detail.html'
        });

        /**
         *
         */
        myapp.run( function( $rootScope, $window, $state, $stateParams) {
            $rootScope.$state = $state;
            $rootScope.$stateParams = $stateParams;
        });
    });
}) (window, window.angular);

