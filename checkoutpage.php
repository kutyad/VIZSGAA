<?php
require_once 'db.php';
include "header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: registerform.php");
    exit();
}

if (!isset($_SESSION['coupon_discount'])) $_SESSION['coupon_discount'] = 0;
if (!isset($_SESSION['coupon_code']))     $_SESSION['coupon_code']     = '';

$coupon_error   = '';
$coupon_success = '';

if (isset($_POST['apply_coupon'])) {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("CALL ValidateCoupon(?)");
    $stmt->bind_param("s", $_POST['coupon_code']);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows) {
        $c = $res->fetch_assoc();
        $_SESSION['coupon_discount'] = $c['discount'];
        $_SESSION['coupon_code']     = $_POST['coupon_code'];
        $coupon_success = "Kupon sikeresen alkalmazva!";
    } else {
        $_SESSION['coupon_discount'] = 0;
        $_SESSION['coupon_code']     = '';
        $coupon_error = "Érvénytelen kuponkód!";
    }

    $stmt->close();
    $conn->close();
}

$conn = getDatabaseConnection();
$stmt = $conn->prepare("CALL GetUserCart(?)");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$cart_items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

$total_price = 0;
foreach ($cart_items as $it) {
    $total_price += $it['product_price'] * $it['quantity'];
}
$final_price = $total_price - $_SESSION['coupon_discount'];

if (isset($_POST['place_order'])) {
    $delivery_type = $_POST['delivery_type'];   
    $salutation    = $_POST['salutation'];
    $first_name    = $_POST['first_name'];
    $last_name     = $_POST['last_name'];
    $country       = $_POST['country'];
    $street        = $_POST['street'];
    $house_number  = $_POST['house_number'];
    $zip_code      = $_POST['zip_code'];
    $city          = $_POST['city'];
    $phone         = $_POST['phone'];

    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("
        CALL PlaceOrder(
          ?,  -- p_user_id
          ?,  -- p_coupon_code
          ?,  -- p_delivery_type
          ?,  -- p_salutation
          ?,  -- p_first_name
          ?,  -- p_last_name
          ?,  -- p_country
          ?,  -- p_street
          ?,  -- p_house_number
          ?,  -- p_zip_code
          ?,  -- p_city
          ?   -- p_phone
        )
    ");

    $stmt->bind_param(
        "isssssssssss",
        $_SESSION['user_id'],
        $_SESSION['coupon_code'],
        $delivery_type,
        $salutation,
        $first_name,
        $last_name,
        $country,
        $street,
        $house_number,
        $zip_code,
        $city,
        $phone
    );

    $stmt->execute();
    $stmt->close();
    $conn->close();

    $_SESSION['coupon_discount'] = 0;
    $_SESSION['coupon_code']     = '';
    header("Location: thankyou.php");
    exit();
}
?>

<section id="cartpart">
  <div class="cart-section">
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-8 mb-4">
          <div class="p-4 bg-light border rounded-0 shadow-sm">
            <h2 class="mb-4">Szállítási adatok</h2>

            <form id="homeForm" method="POST" action="checkoutpage.php">
              <input type="hidden" name="delivery_type" value="home">

              <div class="row g-3 mb-4">
                <div class="col-md-12">
                  <select class="form-control rounded-0" name="salutation" required>
                    <?php $sel = $_POST['salutation'] ?? ''; ?>
                    <option <?= $sel==='Úr'          ? 'selected' : '' ?>>Úr</option>
                    <option <?= $sel==='Hölgy'       ? 'selected' : '' ?>>Hölgy</option>
                    <option <?= $sel==='Egyéb'       ? 'selected' : '' ?>>Egyéb</option>
                    <option <?= $sel==='Nem kívánom' ? 'selected' : '' ?>>Nem kívánom pontosítani</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <input type="text" class="form-control rounded-0"
                         name="first_name" placeholder="Keresztnév" required
                         value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control rounded-0"
                         name="last_name" placeholder="Vezetéknév" required
                         value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>">
                </div>

                <div class="col-md-12">
                  <select class="form-control rounded-0" name="country" required>
                    <option <?= ($_POST['country'] ?? '')==='Magyarország' ? 'selected' : '' ?>>
                      Magyarország
                    </option>
                  </select>
                </div>

                <div class="col-md-8">
                  <input type="text" class="form-control rounded-0"
                         name="street" placeholder="Utca" required
                         value="<?= htmlspecialchars($_POST['street'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control rounded-0"
                         name="house_number" placeholder="Házszám" required
                         value="<?= htmlspecialchars($_POST['house_number'] ?? '') ?>">
                </div>

                <div class="col-md-4">
                  <input type="text" class="form-control rounded-0"
                         name="zip_code" placeholder="Irányítószám" required
                         value="<?= htmlspecialchars($_POST['zip_code'] ?? '') ?>">
                </div>
                <div class="col-md-8">
                  <input type="text" class="form-control rounded-0"
                         name="city" placeholder="Város" required
                         value="<?= htmlspecialchars($_POST['city'] ?? '') ?>">
                </div>

                <div class="col-md-12">
                  <input type="tel" class="form-control rounded-0"
                         name="phone" placeholder="Telefonszám" required
                         value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                </div>
              </div>

              <div class="bg-light p-4 mt-4">
                <p class="mb-3">Fizetési mód: <b>Utánvétes fizetés</b></p>
                <button type="submit"
                        name="place_order"
                        class="btn btn-dark rounded-0 w-100 py-3">
                  Fizetési kötelezettséggel járó megrendelés
                </button>
              </div>
            </form>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="p-4 bg-light border rounded-0 shadow-sm">
            <h4>Rendelés összegzése</h4>
            <p><b>Részösszeg:</b> <?= number_format($total_price,0,',',' ') ?> Ft</p>

            <form method="POST" class="mb-3">
              <p><b>Kuponkód:</b></p>
              <input type="text" name="coupon_code"
                     class="form-control border-0 rounded-0 border-bottom mb-2"
                     placeholder="Kupon kód"
                     value="<?= htmlspecialchars($_SESSION['coupon_code']) ?>">

              <?php if ($coupon_error): ?>
                <div class="alert alert-danger"><?= $coupon_error ?></div>
              <?php endif; ?>
              <?php if ($coupon_success): ?>
                <div class="alert alert-success"><?= $coupon_success ?></div>
              <?php endif; ?>

              <button type="submit"
                      name="apply_coupon"
                      class="btn btn-outline-dark mb-2 rounded-0 w-100">
                Kupon alkalmazása
              </button>
            </form>

            <p><b>Kedvezmény:</b> <?= number_format($_SESSION['coupon_discount'],0,',',' ') ?> Ft</p>
            <p><b>Végösszeg:</b> <?= number_format($final_price,0,',',' ') ?> Ft</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<?php include "footer.php"; ?>
