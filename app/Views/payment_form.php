<form id="paymentForm" method="post" action="<?= esc($action) ?>">

    <input type="hidden" name="api_key" value="<?= esc($api_key) ?>">
    <input type="hidden" name="order_id" value="<?= esc($order_id) ?>">
    <input type="hidden" name="amount" value="<?= esc($amount) ?>">
    <input type="hidden" name="currency" value="<?= esc($currency) ?>">
    <input type="hidden" name="description" value="<?= esc($description) ?>">
    <input type="hidden" name="name" value="<?= esc($name) ?>">
    <input type="hidden" name="email" value="<?= esc($email) ?>">
    <input type="hidden" name="phone" value="<?= esc($phone) ?>">
    <input type="hidden" name="return_url" value="<?= esc($return_url) ?>">
    <input type="hidden" name="hash" value="<?= esc($hash) ?>">
    <input type="hidden" name="city" value="<?= esc($city) ?>">
    <input type="hidden" name="country" value="<?= esc($country) ?>">
    <input type="hidden" name="zip_code" value="<?= esc($zip_code) ?>">
    <input type="hidden" name="split_info" value='<?= esc($split_info) ?>'>
</form>

<script>
    document.getElementById("paymentForm").submit();
</script>