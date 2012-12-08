<h4>TWOJE KONTO</h4>
<fieldset>
<?
    foreach($dane as $item)
    {
        echo '<p>Imie : '.$item->imie.'<p/>';
        echo '<p>Nazwisko : '.$item->nazwisko.'<p/>';
        echo '<p>Email : '.$item->email.'<p/>';
       	echo '<p>Typ : ';
        echo $item->typ == 1 ? 'Administrator' : 'Handlowiec';
        echo '</p>';
    }
?>
</fieldset>