<?php
/*
$conversionJoursFrEngl=array('Lundi'=>'Monday','Mardi'=>'Tuesday','Mercredi'=>'Wednesday','Jeudi'=>'Thursday','Vendredi'=>'Friday','Samedi'=>'Saturday','Dimanche'=>'Sunday');
$conversionJoursEnglEnNum=array('Monday'=>1,'Tuesday'=>2,'Wednesday'=>3, 'Thursday'=>4,'Friday'=>5,'Saturday'=>6,'Sunday'=>7);

$jourFr = 'Samedi';
$jourEngl = $conversionJoursFrEngl[$jourFr];
$prochainJour = strtotime('next '.$jourEngl);

$semaineActuelle = date('W');
$semaineProchainJour = date('W', $prochainJour);

echo date('d/m/Y', $prochainJour);
$timeslots = array( 
    # Timeslot corresponding to Monday 15:00
    array ( 'dow' => $conversionJoursEnglEnNum[$jourEngl], 'hour' => heureEnReel('15:45') ),
);

$date = strtotime('today');
$end_date = strtotime('30 june 2022');
while($date <= $end_date)
{
    # Convert the loop variable to day of week              
    $date_dow = date('w', $date); 

    foreach ($timeslots as $timeslot)
    {
        # Check if it matches the one in the timeslot
        if ($date_dow == $timeslot['dow'])
        {
           $dateSeance = date("D, j M Y H:i", $date + (3600 * $timeslot['hour']));
            echo $dateSeance.'<br>';
        }
    }
    $date += 86400; # advance one day
}

function heureEnReel($val){
    if (empty($val)) {
        return 0;
    }
    $parts = explode(':', $val);
    return $parts[0] + floor(($parts[1]/60)*100) / 100;
}
*/

$conversionJoursFrEngl=array('Lundi'=>'Monday','Mardi'=>'Tuesday','Mercredi'=>'Wednesday','Jeudi'=>'Thursday','Vendredi'=>'Friday','Samedi'=>'Saturday','Dimanche'=>'Sunday');
$conversionJoursEnglEnNum=array('Monday'=>1,'Tuesday'=>2,'Wednesday'=>3, 'Thursday'=>4,'Friday'=>5,'Saturday'=>6,'Sunday'=>7);

$jourFr = 'Samedi';
$jourEngl = $conversionJoursFrEngl[$jourFr];
$prochainJour = strtotime('next '.$jourEngl);

$semaineActuelle = date('W');
$semaineProchainJour = date('W', $prochainJour);

echo date('d/m/Y', $prochainJour);
$timeslots = array( 
    # Timeslot corresponding to Monday 15:00
    array ('dow' => $conversionJoursEnglEnNum[$jourEngl]),
);

$date = strtotime('today');
$end_date = strtotime('30 june 2022');
while($date <= $end_date)
{
    # Convert the loop variable to day of week              
    $date_dow = date('w', $date); 

    foreach ($timeslots as $timeslot)
    {
        # Check if it matches the one in the timeslot
        if ($date_dow == $timeslot['dow'])
        {
           $dateSeance = date("D, j M Y H:i", $date);
            echo $dateSeance.'<br>';
        }
    }
    $date += 86400; # advance one day
}
?>