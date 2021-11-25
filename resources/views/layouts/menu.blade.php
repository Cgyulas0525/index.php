<li class="header">MENŰ</li>
<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('home') !!}"><img src={{ URL::asset('/public/img/menu/homepage_25.jpg')}}><span> Fő oldal</span></a>
</li>
<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('dashboard') !!}"><img src={{ URL::asset('/public/img/menu/dashboard_25.png')}}><span> Vezérlő pult</span></a>
</li>
<li class="{{ Request::is('todos*') ? 'active' : '' }}">
    <a href="{!! route('todos.index') !!}"><img src={{ URL::asset('/public/img/menu/todo_25.png')}}><span> Feladat</span></a>
</li>

<li class="treeview">
    <a href="#">
      <img src={{ URL::asset('/public/img/menu/crm_25.png')}}>
      <span> CRM</span>
      <span class="pull-right-container">
        <span class="fa fa-angle-left pull-right"></span>
    </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('partners*') ? 'active' : '' }}">
            <a href="{!! route('partners.index') !!}"><img src={{ URL::asset('/public/img/menu/partner_25.png')}}><span> Partner</span></a>
        </li>
    </ul>
</li>
<li class="treeview">
    <a href="#">
        <img src={{ URL::asset('/public/img/menu/keszlet_25.png')}}>
        <span> Készlet</span>
        <span class="pull-right-container">
            <span class="fa fa-angle-left pull-right"></span>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="treeview">
            <a href="#">
                <img src={{ URL::asset('/public/img/menu/keszlet_25.png')}}><span> Készlet</span>
                <span class="pull-right-container">
                        <span class="fa fa-angle-left pull-right"></span>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ Request::is('termekfocsoports*') ? 'active' : '' }}">
                    <a href="{!! route('termekfocsoports.index') !!}"><img src={{ URL::asset('/public/img/menu/termekcsoport_25.png')}}><span> Termék csoport</span></a>
                </li>
                <li class="{{ Request::is('termeks*') ? 'active' : '' }}">
                    <a href="{!! route('termeks.index') !!}"><img src={{ URL::asset('/public/img/menu/products_25.png')}}><span> Termék</span></a>
                </li>
                <li class="{{ Request::is('raktarKeszlets*') ? 'active' : '' }}">
                    <a href="{!! route('raktarKeszlets.index') !!}"><img src={{ URL::asset('/public/img/menu/raktar_25.jpg')}}><span> Raktár készlet</span></a>
                </li>
                <li class="{{ Request::is('termekfocsoports*') ? 'active' : '' }}">
                    <a href="{!! route('pekaru.index') !!}"><img src={{ URL::asset('/public/img/menu/pekaru_25.png')}}><span> Pékárú</span></a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <img src={{ URL::asset('/public/img/menu/km_25.jpg')}}><span> Készlet mozgás</span>
                <span class="pull-right-container">
                    <span class="fa fa-angle-left pull-right"></span>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ Request::is('mozgaskods*') ? 'active' : '' }}">
                    <a href="{!! route('mozgaskods.index') !!}"><img src={{ URL::asset('/public/img/menu/mozgaskod_25.jpg')}}><span> Mozgáskód</span></a>
                </li>
                <li class="{{ Request::is('termeks*') ? 'active' : '' }}">
                    <a href="{!! route('megrendelesfejs.index') !!}"><img src={{ URL::asset('/public/img/menu/megrendeles_25.png')}}><span> Megrendelés</span></a>
                </li>
                <li class="{{ Request::is('termeks*') ? 'active' : '' }}">
                    <a href="{!! route('mozgasfejs.index') !!}"><img src={{ URL::asset('/public/img/menu/szamla_25.png')}}><span> Mozgás bizonylat</span></a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <img src={{ URL::asset('/public/img/menu/leltar_25.jpg')}}><span> Leltár</span>
                <span class="pull-right-container">
                    <span class="fa fa-angle-left pull-right"></span>
                </span>
            </a>
            <ul class="treeview-menu">
<!--
                <li class="{{ Request::is('mozgaskods*') ? 'active' : '' }}">
                    <a href="{!! route('mozgaskods.index') !!}"><img src={{ URL::asset('/public/img/menu/leltar_25.jpg')}}><span> Nyitó leltár</span></a>
                </li>
-->
                <li class="{{ Request::is('termeks*') ? 'active' : '' }}">
                    <a href="{!! route('leltarFejs.index') !!}"><img src={{ URL::asset('/public/img/menu/leltar1_25.jpg')}}><span> Leltár</span></a>
                </li>
            </ul>
        </li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <img src={{ URL::asset('/public/img/menu/penzugy_25.png')}}>
        <span> Pénzügy</span>
        <span class="pull-right-container">
            <span class="fa fa-angle-left pull-right"></span>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('koltsegfocsoports*') ? 'active' : '' }}">
            <a href="{!! route('koltsegfocsoports.index') !!}"><img src={{ URL::asset('/public/img/menu/ktgfocsoport_25.png')}}><span> Költség nem</span></a>
        </li>
        <li class="{{ Request::is('szamlas*') ? 'active' : '' }}">
            <a href="{!! route('szamlas.index') !!}"><img src={{ URL::asset('/public/img/menu/szamla_25.png')}}><span> Számla</span></a>
        </li>
        <li class="{{ Request::is('penztarFejs*') ? 'active' : '' }}">
            <a href="{!! route('penztarFejs.index') !!}"><img src={{ URL::asset('/public/img/menu/penztar_25.jpg')}}><span> Pénztár</span></a>
        </li>
    </ul>
</li>
<li class="treeview">
    <a href="#">
      <img src={{ URL::asset('/public/img/menu/szotar_25.png')}}>
      <span> Szótár</span>
      <span class="pull-right-container">
        <span class="fa fa-angle-left pull-right"></span>
    </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ Request::is('telepules*') ? 'active' : '' }}">
          <a href="{!! route('telepules.index') !!}"><img src={{ URL::asset('/public/img/menu/telepules_25.png')}}><span> Település</span></a>
      </li>
      <li class="{{ Request::is('dictionaries*') ? 'active' : '' }}">
          <a href="{!! route('types.index') !!}"><img src={{ URL::asset('/public/img/menu/szotar_25.png')}}><span> Szótár</span></a>
      </li>
        <li class="{{ Request::is('moduls*') ? 'active' : '' }}">
            <a href="{!! route('moduls.index') !!}"><img src={{ URL::asset('/public/img/menu/modul_25.jpg')}}><span> Modulok</span></a>
        </li>
        <li class="{{ Request::is('listas*') ? 'active' : '' }}">
            <a href="{!! route('listas.index') !!}"><img src={{ URL::asset('/public/img/menu/lista_25.png')}}><span> Listák</span></a>
        </li>
        <li class="{{ Request::is('modulidoszaks*') ? 'active' : '' }}">
            <a href="{!! route('modulidoszaks.index') !!}"><img src={{ URL::asset('/public/img/menu/period_25.png')}}><span> Időszak</span></a>
        </li>
        <li class="{{ Request::is('modulszuros*') ? 'active' : '' }}">
            <a href="{!! route('modulszuros.index') !!}"><img src={{ URL::asset('/public/img/menu/szuro_25.png')}}><span> Szűrők</span></a>
        </li>
    </ul>
</li>
<li class="{{ Request::is('zaras*') ? 'active' : '' }}">
    <a href="{!! route('zaras.index') !!}"><img src={{ URL::asset('/public/img/menu/zaras_25.jpg')}}><span> Zárás</span></a>
</li>

<!--
<li class="{{ Request::is('penztarTetels*') ? 'active' : '' }}">
    <a href="{!! route('penztarTetels.index') !!}"><i class="fa fa-edit"></i><span>Penztar Tetels</span></a>
</li>
<li class="{{ Request::is('termeks*') ? 'active' : '' }}">
    <a href="{!! route('felhasznalasIndex') !!}"><img src={{ URL::asset('/public/img/menu/csokkenes_25.png')}}><span> Felhasználás</span></a>
</li>
<li class="{{ Request::is('leltarFejs*') ? 'active' : '' }}">
    <a href="{!! route('leltarFejs.index') !!}"><i class="fa fa-edit"></i><span>Leltar Fejs</span></a>
</li>

<li class="{{ Request::is('leltarTetels*') ? 'active' : '' }}">
    <a href="{!! route('leltarTetels.index') !!}"><i class="fa fa-edit"></i><span>Leltar Tetels</span></a>
</li>
<li class="{{ Request::is('keps*') ? 'active' : '' }}">
    <a href="{!! route('keps.index') !!}"><i class="fa fa-edit"></i><span>Keps</span></a>
</li>
<li class="{{ Request::is('vevoirendelestetels*') ? 'active' : '' }}">
    <a href="{!! route('vevoirendelestetels.index') !!}"><i class="fa fa-edit"></i><span>Vevoirendelestetels</span></a>
</li>
-->


<li class="{{ Request::is('vevoirendelesfejs*') ? 'active' : '' }}">
    <a href="{!! route('vevoirendelesfejs.index') !!}"><img src={{ URL::asset('/public/img/menu/order_25.png')}}><span> Vevői rendelés</span></a>
</li>





