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
              <a class="nav-link" href="?task=settings&action=index"><i class="icon-cog-alt"></i> Ustawienia</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="templates/logout.php"><i class="icon-logout"></i> Wyloguj się</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>