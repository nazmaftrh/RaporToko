</div>

<?php if (isset($_SESSION['flash'])): ?>
<script>
Swal.fire({
    icon: '<?= $_SESSION['flash']['type'] ?>',
    text: '<?= $_SESSION['flash']['message'] ?>',
    timer: 2000,
    showConfirmButton: false
});
</script>
<?php unset($_SESSION['flash']); ?>
<?php endif; ?>


<footer class="footer">
    <div class="footer-inner">

        <div class="footer-left">
            <a href="<?= $setting['footer_left'] ?>" target="_blank" class="footer-link">
                Instagram <br>
                @mamabikitchen
            </a>
        </div>

        <div class="footer-center">
            <?= $setting['footer_center'] ?>
        </div>

        <div class="footer-right">
            <strong><?= $setting['app_name'] ?></strong><br>
            <small><?= $setting['app_subtitle'] ?></small>
        </div>
    </div>
</footer>

</body>
</html>
