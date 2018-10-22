<?php
    if(isset($_SESSION['message']))
    {
      echo '<div class="error">' . $_SESSION['message'] . '</div>';
      unset($_SESSION['message']);
    }

    if(isset($_SESSION['registration_approved']))
    {
      $_SESSION['registration_approved'] = "Rejestracja przebiegła pomyślnie. Możesz się już zalogować!";
      
      echo '<div class="approved">' . 
            $_SESSION['registration_approved'] . 
            '</div>';

      unset($_SESSION['registration_approved']);
    }

    if(isset($_SESSION['income_approved']))
    {
      $_SESSION['income_approved'] = "Pomyślnie dodano przychód!";
      
      echo '<div class="approved">' . 
            $_SESSION['income_approved'] . 
            '</div>';
            
      unset($_SESSION['income_approved']);
    }

    if(isset($_SESSION['expense_approved']))
    {
      $_SESSION['expense_approved'] = "Pomyślnie dodano wydatek!";
      
      echo '<div class="approved">' . 
            $_SESSION['expense_approved'] . 
            '</div>';
            
      unset($_SESSION['expense_approved']);
    }
?>
