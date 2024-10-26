<?php
session_start();
include '../includes/connection.php';

if (isset($_POST['patient_id'])) {
    $id = $_POST['patient_id'];

    $sql = "SELECT * FROM patients WHERE id = $id";
    $run = mysqli_query($con, $sql);
    $details = mysqli_fetch_assoc($run);
    $phone = $details['phone'];
    $email = $details['email'];
    $sql = '';

    if ($phone != null || $phone != '') {
        $sql2 = "SELECT * FROM patients WHERE phone = $phone";
    } else if ($email != null || $email != '') {
        $sql2 = "SELECT * FROM patients WHERE email = '$email'";
    } ?>

    <h3 class="mb-4"><?php echo $details['first_name'] . ' ' . $details['last_name'].' Report' ?></h3>
    <?php
    $run2 = mysqli_query($con, $sql2);
    while ($details2 = mysqli_fetch_assoc($run2)) { ?>
        <div class="record" style="margin-bottom: 40px; padding-bottom: 6px; border-bottom: 2px solid #000;">
            <p class="w-100"><i><b>Treatment Date:</b></i>
            <?php
            $treatment_date = $details2['updated_at'];
            echo date('M d, Y', strtotime($treatment_date));
            ?>
            </p>
            <p class="analysis"><i><b>Doctor Analysis:</b></i><?php echo ' '.$details2['analysis'] ?></p>
            <p class="medication"><i><b>Medication:</b></i><?php echo ' '.$details2['medicines'] ?></p>
        </div>
        <?php
    }?>
    <button class="report_close btn btn-sm btn-dark mt-3">Close</button>
    <button class="pdf btn btn-sm btn-light mt-3 mx-2 text-danger" value="<?php echo $details['first_name'] . ' ' . $details['last_name']?>">Print</button>
    <?php
}