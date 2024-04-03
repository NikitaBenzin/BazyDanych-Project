<?php

include("../dbconfig.php");

// JSON 
$pdo = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_server, $db_user, $db_pass);

// Начало сессии
session_start();

// Запись данных из $_POST в сессию
$_SESSION['productIdArray'] = $_POST['productIdArray'];
$_SESSION['productAmountArray'] = $_POST['productAmountArray'];
$_SESSION['productPriceArray'] = $_POST['productPriceArray'];
$_SESSION['totalAmount'] = $_POST['totalAmount'];
$totalAmount = $_POST['totalAmount'];

echo '
  <section class="products">
    <span>Złożenie zamówienia</span>
    <div class="order-section">
      <section class="card order-delivery">
        <span class="section-name info-row">
          <p>Dostawa kurierem</p>
          <span class="summary-value">10,99 zł</span>
        </span>
        <span class="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2466.3594856543896!2d19.200728773996293!3d50.0265926536857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4716958605e8ce0f%3A0xd3b3d6e6a755d0b6!2sMa%C5%82opolska%20Uczelnia%20Pa%C5%84stwowa%20im.%20rotmistrza%20Witolda%20Pileckiego%20w%20O%C5%9Bwi%C4%99cimiu!5e0!3m2!1sru!2spl!4v1712137893470!5m2!1sru!2spl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </span>

        <span class="section-name">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-480q33 0 56.5-23.5T560-560q0-33-23.5-56.5T480-640q-33 0-56.5 23.5T400-560q0 33 23.5 56.5T480-480Zm0 294q122-112 181-203.5T720-552q0-109-69.5-178.5T480-800q-101 0-170.5 69.5T240-552q0 71 59 162.5T480-186Zm0 106Q319-217 239.5-334.5T160-552q0-150 96.5-239T480-880q127 0 223.5 89T800-552q0 100-79.5 217.5T480-80Zm0-480Z"/></svg>
          <p>Adres dostawy</p>
        </span>
        <div class="order-address">

          <form id="addressForm">
            <input type="text" id="street" name="street" placeholder="Ulica" required autocomplete>
            <div>
              <input type="text" id="houseNumber" name="houseNumber" placeholder="Nr domu" required autocomplete>
              <input type="text" id="flatNumber" name="flatNumber" placeholder="Nr lokalu" required autocomplete>
            </div>
            <input type="text" id="zip" name="zip" pattern="^[0-9]{2}-[0-9]{3}$" placeholder="__-___" required autocomplete>
            <input type="text" id="city" name="city" placeholder="Miejscowość" required autocomplete>
          </form>

        </div>
      </section>
      
      <section class="order-info">
        <section class="card order-summary">
          <span class="section-name">Twoje zamówienie</span>
          <div class="order-summary-values">
            <div class="info-row">
              <span class="summary-name">Wartość produktów</span>
              <span class="summary-value">' . $totalAmount . ' zł</span>
            </div>
            <div class="info-row">
              <span class="summary-name">Koszt dostawy</span>
              <span class="summary-value">10,99 zł</span>
            </div class="info-row">
            <div class="info-row">
              <span class="summary-name">Łącznie</span>
              <span class="summary-value">' . $totalAmount + 10.99 . ' zł</span>
            </div>
          </div>
        </section>

        <section class="card order-payment">
          <span class="section-name">Wybierz płatność</span>
          <div class="order-summary-values">
            <div class="info-row">
              <span class="summary-name">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path fill="#101010" d="M240-160q-50 0-85-35t-35-85H40v-440q0-33 23.5-56.5T120-800h560v160h120l120 160v200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H360q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T280-280q0-17-11.5-28.5T240-320q-17 0-28.5 11.5T200-280q0 17 11.5 28.5T240-240ZM120-360h32q17-18 39-29t49-11q27 0 49 11t39 29h272v-360H120v360Zm600 120q17 0 28.5-11.5T760-280q0-17-11.5-28.5T720-320q-17 0-28.5 11.5T680-280q0 17 11.5 28.5T720-240Zm-40-200h170l-90-120h-80v120ZM360-540Z"/></svg>

                
                <select id="payMethod" name="payMethod" required>
                  <option selected>Gotówka przy odbiorze</option>
                  <option>Karta płatnicza przez Internet</option>
                  <option>BLIK</option>
                </select>
                
              </span>
        
            </div>
            <div class="info-row">
              <span class="summary-name coupon">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path fill="#101010" d="M480-280q17 0 28.5-11.5T520-320q0-17-11.5-28.5T480-360q-17 0-28.5 11.5T440-320q0 17 11.5 28.5T480-280Zm0-160q17 0 28.5-11.5T520-480q0-17-11.5-28.5T480-520q-17 0-28.5 11.5T440-480q0 17 11.5 28.5T480-440Zm0-160q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm320 440H160q-33 0-56.5-23.5T80-240v-160q33 0 56.5-23.5T160-480q0-33-23.5-56.5T80-560v-160q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v160q-33 0-56.5 23.5T800-480q0 33 23.5 56.5T880-400v160q0 33-23.5 56.5T800-160Zm0-80v-102q-37-22-58.5-58.5T720-480q0-43 21.5-79.5T800-618v-102H160v102q37 22 58.5 58.5T240-480q0 43-21.5 79.5T160-342v102h640ZM480-480Z"/></svg>
                <p>Masz kod promocyjny?</p>
              </span>
              <svg width="8.000000" height="5.000000" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc></desc><defs /><path fill="#838383" id="Vector" d="M4 5L0 1.24L1.33 0L4 2.5L6.66 0L8 1.24L4 5Z" fill="#101010" fill-opacity="1.000000" fill-rule="nonzero" /></svg>
            </div>
          </div>
        </section>

        <section class="card order-number">
          <span class="section-name">Numer telefonu</span>
          <input type="tel" id="phone" inputmode="numeric" name="phone" placeholder="___ ___ ___" required autocomplete>
        </section>

        <button type="button" id="submitOrder" onclick="submitOrder()">Złóż zamówienie</button>
      </section>
    </div>
  </section>

  <script src="../../js/order.js"/>
';
$pdo = null;
