<?php
// Define your settings here. Set them as null or empty to not use their respective features.

// General settings.
const CONTACT_EMAIL = 'example@example.com'; // The email you want to be contacted at. Optional.
const HTTPS_PROXY = false; // Set this to true if you're using an HTTPS proxy like Cloudflare for your site's main domain, or false if you're not or don't know what that is. Required.
const TIMEZONE = 'America/New_York'; // The timezone used by the site. Required.
const ALLOW_PROXY = false; // Allows or disallows users to sign in with a proxy.
const ALLOW_SIGNUP = true; // Disables signup.

// Changeable text.
const SITE_NAME = "bruhclone";
const FEED_NOTICE = "There's no notice currently."; // Notice that appears on feed.

// Database settings.
const DB_HOST = 'localhost'; // The hostname of your database server. Required.
const DB_USER = 'db_user'; // The username you'll use to access the database. Required.
const DB_PASS = 'db_pass'; // The password you'll use to access the database. Optional.
const DB_NAME = 'db_name'; // The name of the database. Required.

// Ads. Don't set stuff if you don't know what this is for.
const AD_LINK = "https://example.com"; // Link for ad.
const AD_IMG = "https://cdn.example.com/ads/example.png"; // Image for ad. Displayed on the homepage.
const AD2_LINK = "https://example.com"; // Link for second ad.
const AD2_IMG = "https://cdn.example.com/ads/example.png"; // Image for second ad. Displayed on communities

// Local Image settings. Not really recommended.
const IMAGE_LOCAL = false;
const IMAGE_LOCAL_BASE_DIR = "C://xampp//htdocs//galaxyplaza_offdevice//assets//img//";
const IMAGE_LOCAL_BASE_URL = "/assets/img/";

// Cloudinary settings.
const USE_CLOUDINARY = true;
const CLOUDINARY_CLOUDNAME = 'cloude_name'; // The cloud name of your Cloudinary account. Required.
const CLOUDINARY_UPLOADPRESET = 'uploade_preset'; // The unsigned upload preset of your Cloudinary account. Required.

// Gravatar settings.
const GRAVATAR_IMAGE_SIZE = "256"; // ex: 96px, 128px, 256px.

// ReCAPTCHA settings.
const RECAPTCHA_PUBLIC = null; // Your ReCAPTCHA public key. Optional.
const RECAPTCHA_SECRET = null; // Your ReCAPTCHA private key. Optional.
?>
