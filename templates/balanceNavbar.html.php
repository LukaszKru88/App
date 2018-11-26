    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <div class="container">
        <div class="menu navbar-brand"><?='<p style="margin-bottom: 0px;">Witaj ' . $_SESSION['username'] . '!'; ?></div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center menu" id="navbarSupportedContent">
          <ul class="nav navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php"><i class="icon-home"></i> Menu Główne</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?task=addIncome&action=addIncomeView"><i class="icon-money"></i> Dodaj przychód</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?task=addExpense&action=addExpenseView"><i class="icon-basket"></i> Dodaj wydatek</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?task=showBalance&action=index"><i class="icon-chart-pie"></i> Przeglądaj bilans</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="icon-cog-alt"></i> Ustawienia</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="templates/logout.php"><i class="icon-logout"></i> Wyloguj się</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-calendar"></i> Zakres Bilansu</a>

              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="?task=showBalance&action=index"><label class="form-check-label" name="time_period" id="exampleRadios1" value="this_month">Bieżący miesiąc</label></a>

                <a class="dropdown-item" href="?task=showBalance&action=index&timePeriod=lastMonth"><label class="form-check-label" name="time_period" id="exampleRadios2"  value="last_month">Poprzedni miesiąc</label></a>

                <a class="dropdown-item" href="?task=showBalance&action=index&timePeriod=thisYear"><label class="form-check-label" name="time_period" id="exampleRadios3"  value="this_year">Bieżący rok</label></a>
                <div class="dropdown-divider"></div>

                <a class="dropdown-item"><label class="form-check-label" name="time_period" id="exampleRadios4"  value="another" data-toggle="modal" data-target="#myModal"
                >Niestandardowy</label></a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <form method="post" action="?task=showBalance&action=index&timePeriod=another">
      <div  id="myModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="col-lg-6 col-md-12  float-left">
                  <div class="tablesHeading">Data początkowa
                    <input class="form-control" name="start_date" type="date" 
                    value="<?php echo $current_date=date("Y-m-d", strtotime("first day of this month"))?>"/>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12  float-left">
                  <div class="tablesHeading">Data końcowa
                    <input class="form-control" name="end_date" type="date" 
                    value="<?php echo $current_date=date("Y-m-d")?>"/>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <div class="modal-footer">
            <button class="btn btn-info" name="time_period" value="another">Potwierdź</button> 
            <button type="button" class="btn btn-success" data-dismiss="modal">Wróć</button>
            </div>
          </div>
        </div>
      </div>
    </form>
