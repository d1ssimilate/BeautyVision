<footer class="footer">
    <div class="footer__content container">
        <ul class="footer__links">
            <?php
                $args = [
                    'menu_class'        => 'footer__menu', 
                    'menu_id'           => false, 
                    'echo'              => true,
                    'depth'             => 0, 
                    'walker'            => '',
                    'theme_location'    => '', 
                ];
                wp_nav_menu($args);
                ?>
        </ul>
        <div class="footer__info">
            <p>© 2024</p>
            <p>Макаров Роман Дис-213/21 Б</p>
        </div>
    </div>
</footer>
</div>
</body>

</html>