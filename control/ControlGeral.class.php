<?php

/**
 * Ativar a segurança do sistema
 */
new Secure();

/**
 * Criado em 01/01/2015
 * Classe de controle geral
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class ControlGeral {

    /**
     * Método utilizado para transforma para para o formato brasileiro
     * @access public 
     * @param Date $data data no formato americado (Y-m-d)
     * @return Date data no formato brasileiro (d/m/Y)
     */
    function dataBrasileiro($data) {

        if ($data == null) {
            return '';
        } else {
            return date('d/m/Y', strtotime($data));
        }
    }

    /**
     * Método utilizado para transforma para para o formato americado
     * @access public 
     * @param Date $data data no formato brasileiro (d/m/Y) 
     * @return Date data no formato americano (Y-m-d)
     */
    function dataAmericano($data) {

        if ($data == null) {
            return '';
        } else {
            return date('Y-m-d)', strtotime($data));
        }
    }

    /**
     * Método utilizado para transforma para validar e-mail
     * @access public 
     * @param String $email e-mail a ser validado
     * @return Boolean retorna TRUE se o e-mail for válido
     */
    public static function validarEmail($email) {
        return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
    }

    /**
     * Método utilizado para mostrar mensagens do sistema
     * @access public 
     * @param String $msg mensagem a ser exibida
     */
    function alerta($msg) {
        $alerta = '';
        if ($msg !='') {
            $alerta = '<div class="alert alert-success fade in">';
            $alerta.='<button type="button" class="close" data-dismiss="alert">×</button>';
            $alerta.='<strong>Informação: </strong>' . $msg . '</div>';
        }
        return $alerta;
    }

    /**
     * Método utilizado para mostrar o menu do sistema
     * @access public 
     * @param String $nomeSistema nome do sistema a ser exibido
     */
    function menu() {
        echo' <!--Static navbar -->';
        echo' <nav class = "navbar navbar-default">';
        echo' <div class = "container-fluid">';
        echo' <div class = "navbar-header">';
        echo' <button type = "button" class = "navbar-toggle collapsed" data-toggle = "collapse" data-target = "#navbar" aria-expanded = "false" aria-controls = "navbar">';
        echo' <span class = "sr-only"></span>';
        echo' <span class = "icon-bar"></span>';
        echo' <span class = "icon-bar"></span>';
        echo' <span class = "icon-bar"></span>';
        echo' </button>';
        echo' <a class = "navbar-brand" href = "modulo.php?modulo=principal"><span class="glyphicon glyphicon-home"></span></a>';
        echo' </div>';
        echo'  <div id = "navbar" class = "navbar-collapse collapse">';
        echo' <ul class = "nav navbar-nav">';

        #menu cliente
        echo' <li class = "dropdown">';
        echo'  <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" role = "button" aria-haspopup = "true" aria-expanded = "false"><span class="glyphicon glyphicon-user"></span> Cliente<span class = "caret"></span></a>';
        echo'  <ul class = "dropdown-menu">';
        echo' <li><a href = "modulo.php?modulo=cliente&menu=consultar"><i class="icon-large icon-search"></i><span class="glyphicon glyphicon-search"></span> Consultar</a></li>';
        echo'  <li><a href = "modulo.php?modulo=cliente&menu=inserir"><span class="glyphicon glyphicon-plus-sign"></span> Inserir</a></li>';
        echo' </ul>';
        echo' </li>';

        #menu exemplo
        //        echo' <li class = "dropdown">';
        //        echo'  <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" role = "button" aria-haspopup = "true" aria-expanded = "false">Exemplo<span class = "caret"></span></a>';
        //        echo'  <ul class = "dropdown-menu">';
        //        echo' <li><a href = "modulo.php?modulo=&menu=consultar"><i class="icon-large icon-search"></i>Consultar</a></li>';
        //        echo'  <li><a href = "modulo.php?modulo=usuario&menu=inserir">Inserir</a></li>';
        //        echo' </ul>';
        //        echo' </li>';

        echo' </ul>';
        echo'<ul class="nav navbar-nav navbar-right">';
        echo'<li class="dropdown">';
        echo' <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Usuário <span class="caret"></span></a>';
        echo'<ul class="dropdown-menu">';
        echo'<li><a href="#"><span class="glyphicon glyphicon-pencil"></span> Alterar Senha</a></li>';
        echo'<li><a href="#"><span class="glyphicon glyphicon-cog"></span> Configurações</a></li>';
        echo'<li><a href="#"><span class="glyphicon glyphicon-list-alt"></span> Sobre</a></li>';
        echo'<li role="separator" class="divider"></li>';
        echo'<li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>';
        echo' </ul>';
        echo'</li>';
        echo'</ul>';
        echo' </div><!--/.nav-collapse -->';
        echo' </div><!--/.container-fluid -->';
        echo' </nav>';
    }

}
