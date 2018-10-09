<?php
require_once('./library/db.php');
require_once('./models/Kudos.php');

$c = DB::connect();

if(isset($_GET['id'])){
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">From User</th>
                    <th scope="col">To User</th>
                    <th scope="col">Message</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Count</th>
                </tr>
            </thead>
            <tbody>
        <?php

        $r = $c->query("SELECT * FROM kudos WHERE id={$_GET['id']}");
        $row = $r->fetch_assoc();
        $kudos = new Kudos($row);

        ?>
                <tr>
                    <td>@<?=$kudos->getFromUser()?></td>
                    <td>@<?=$kudos->getToUser()?></td>
                    <td><?=$kudos->message?></td>
                    <td><?=$kudos->date?></td>
                    <td><?=$kudos->time?></td>
                    <td><?=$kudos->count?></td>
                </tr>
            </tbody>
        </table>
        <?php
}
else{
    ?>
    <table class="table table-hover table-dark" style="cursor: pointer">
        <thead>
            <tr>
                <th scope="col">From User</th>
                <th scope="col">To User</th>
                <th scope="col">Date</th>
                <th scope="col">Count</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $r = $c->query("SELECT * FROM kudos ORDER BY date, time DESC");
    if(mysqli_num_rows($r)){
        while($row = $r->fetch_assoc()){
            $kudos = new Kudos($row);
            ?>
            <tr onclick="window.location='index.php?a=kudosPreview&id=<?=$kudos->getId()?>'">
                <td>@<?=$kudos->getFromUser()?></td>
                <td>@<?=$kudos->getToUser()?></td>
                <td><?=$kudos->date?></td>
                <td><?=$kudos->count?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
        <?php
    }
    else{
        echo '<h6>You have yet to Kudos a colleague!</h6>';
    }
}
    ?>
</div>