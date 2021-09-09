<?php
/*
Template name: Page - child mainpage
*/
get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>

<div id="content" role="main">
    <img src="/wp-content/uploads/2021/09/logo.svg" class="mainpage-logo">
    <section>
        <div class=" container">
            <div class="mainpage-chapters">
                <div class="chapter-item with-gallery">
                    <div class="chapter-images-box">
                        <img src="/wp-content/uploads/2021/09/chapter-1.jpg" class="chapter-image is-active">
                        <img src="/wp-content/uploads/2021/09/chapter-2.jpg" class="chapter-image">
                        <img src="/wp-content/uploads/2021/09/chapter-3.jpg" class="chapter-image">
                    </div>
                    <h3 class="chapter-title">Delivery</h3>
                    <p class="chapter-text">Description, some details</p>
                    <a href="#" class="chapter-btn btn btn-black btn-big">ORDER NOW</a>
                </div>
                <div class="chapter-item with-gallery">
                    <div class="chapter-images-box">
                        <img src="/wp-content/uploads/2021/09/chapter-2.jpg" class="chapter-image is-active">
                        <img src="/wp-content/uploads/2021/09/chapter-1.jpg" class="chapter-image">
                        <img src="/wp-content/uploads/2021/09/chapter-3.jpg" class="chapter-image">
                    </div>
                    <h3 class="chapter-title">Shop</h3>
                    <p class="chapter-text">Description, some details</p>
                    <a href="#" class="chapter-btn btn btn-black btn-big">VIEW ALL</a>
                </div>
                <div class="chapter-item">
                    <div class="chapter-images-box">
                        <img src="/wp-content/uploads/2021/09/chapter-3.jpg" class="chapter-image is-active">
                        <img src="/wp-content/uploads/2021/09/chapter-1.jpg" class="chapter-image">
                        <img src="/wp-content/uploads/2021/09/chapter-2.jpg" class="chapter-image">
                    </div>
                    <h3 class="chapter-title">B2B</h3>
                    <p class="chapter-text">For partners</p>
                    <a href="#" class="chapter-btn btn btn-black btn-big">MORE</a>
                </div>
                <div class="chapter-item">
                    <div class="chapter-images-box">
                        <img src="/wp-content/uploads/2021/09/chapter-4.jpg" class="chapter-image is-active">
                        <img src="/wp-content/uploads/2021/09/chapter-2.jpg" class="chapter-image">
                        <img src="/wp-content/uploads/2021/09/chapter-3.jpg" class="chapter-image">
                    </div>
                    <h3 class="chapter-title">About us</h3>
                    <p class="chapter-text">Description, some details</p>
                    <a href="#" class="chapter-btn btn btn-black btn-big">MORE</a>
                </div>

            </div>    </div>
    </section>
</div>

<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
