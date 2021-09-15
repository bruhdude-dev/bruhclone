<?php
// Define your settings here. Set them as null or empty to not use their respective features.

// General settings.
const CONTACT_EMAIL = 'example@example.com'; // The email you want to be contacted at. Optional.
const HTTPS_PROXY = false; // Set this to true if you're using an HTTPS proxy like Cloudflare for your site's main domain, or false if you're not or don't know what that is. Required.
const TIMEZONE = 'America/New_York'; // The timezone used by the site. Required.

// Auth settings.
const ALLOW_PROXY = false; // Allows or disallows users to sign in with a proxy.
const ALLOW_SIGNUP = false; // Disables signup.
const DISABLE_REASON = "Because."; // Disabled signups reason. This doesn't work because I am a lazy sack of potatoe.

// Info settings.
const SITE_NAME = "bruhclone"; // Site name. Appears in feed and a bunch of other places.

// Locale stuff.
const MEMO_TITLE = "What is bruhclone?"; // Title above the memo text. Displayed on the homepage.
const MEMO_TEXT = "bruhclone is a social network for people who want to talk about games, stuff, memes, and other things!"; // Text below the memo title. Displayed on the homepage.
const FEED_NOTICE = "McDonals"; // fun slide

// Ads. Don't set stuff if you don't know what this is for.
const AD_LINK = ""; // Link for ad.
const AD_IMG = ""; // Image for ad. Displayed on the homepage.
const AD2_LINK = ""; // Link for second ad.
const AD2_IMG = ""; // Image for second ad. Displayed on communities

// Database settings.
const DB_HOST = 'localhost'; // The hostname of your database server. Required.
const DB_USER = 'root'; // The username you'll use to access the database. Required.
const DB_PASS = ''; // The password you'll use to access the database. Optional.
const DB_NAME = 'database_name'; // The name of the database. Required.

// Local Image settings. Not really recommended.
const IMAGE_LOCAL = false;
const IMAGE_LOCAL_BASE_DIR = "C://xampp//htdocs//galaxyplaza_offdevice//assets//img//";
const IMAGE_LOCAL_BASE_URL = "/assets/img/";

// Cloudinary settings. Recommended. https://cloudinary.com/signup/
const USE_CLOUDINARY = true;
const CLOUDINARY_CLOUDNAME = ''; // The cloud name of your Cloudinary account. Required.
const CLOUDINARY_UPLOADPRESET = 'ml_default'; // The unsigned upload preset of your Cloudinary account. Required.

// Gravatar settings.
const GRAVATAR_IMAGE_SIZE = "256"; // ex: 96px, 128px, 256px.

// ReCAPTCHA settings.
const RECAPTCHA_PUBLIC = null; // Your ReCAPTCHA public key. Optional.
const RECAPTCHA_SECRET = null; // Your ReCAPTCHA private key. Optional.
?>