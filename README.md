### Woordle

Requires at least: 5.0

Tested up to: 5.1.1

Stable tag: 0.9.5

Requires PHP: 5.6.*

#### Description

Wordle is the best online school management system for WordPress.

With Woordle, you can earn online courses, sell them using Woocommerce, and migrate them to Moodle. All in a simple and fast way.

#### Features:

* Create courses in a simple way
* Configure how your course will be migrated to Moodle. (topics, social, etc.)
* Sell ​​your course with Woocomemrce.
* Apply promotions, discount coupons on the product of your course.
* Simple enrollment process with a click, your students can enroll
* Enrollment approval. You can set whether your subscriptions will be automatically released or require moderator approval.
* Automatic Migration of Moodle enrollments, whenever it is published.

#### Installation

This section describes how to install the plugin and get it working.

e.g.

1. Upload the plugin files to the `/wp-content/plugins/woordle` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Plugin Name screen to configure the plugin
1. (Make your instructions match the desired user flow for activating and installing your plugin. Include any steps that might be needed for explanatory purposes)


#### Frequently Asked Questions

**Am I required to have Woocommerce installed?**

No, but without Woocommerce, you will not be able to apply any type of charges in the registrations.

**How do I set up Moodle to receive my courses and students?**

You should set up a webservice. You can see our documentation [here](https://zero62.com/woordle/docs)

**What functions should I enable in the Moodle webservice?students?**

You should enable the functions below:

* `core_course_create_categories`
* `core_course_create_courses`
* `core_course_get_categories`
* `core_course_get_courses`
* `core_course_get_courses_by_field`
* `core_course_update_categories`
* `core_course_update_courses`
* `core_user_create_users`
* `core_user_get_users`
* `enrol_manual_enrol_users`

#### Screenshots

![Course 01](https://zero62.com/plugins/woordle-images/course-01.png)

![](https://zero62.com/plugins/woordle-images/course-02.png)

![](https://zero62.com/plugins/woordle-images/course-03.png)

![](https://zero62.com/plugins/woordle-images/course-04.png)

![](https://zero62.com/plugins/woordle-images/course-categories-01.png)

![](https://zero62.com/plugins/woordle-images/enrolment-01.png)

![](https://zero62.com/plugins/woordle-images/enrolment-02.png)

![](https://zero62.com/plugins/woordle-images/moodle-01.png)

![](https://zero62.com/plugins/woordle-images/moodle-02.png)

![](https://zero62.com/plugins/woordle-images/settings-01.png)

![](https://zero62.com/plugins/woordle-images/woocommerce-01.png)

#### Changelog

= 0.9.1 =

    * Fix bugs and improvements

= 0.9.0 =

    * Created single course page
    * Created archive course page

= 0.8.0 =

    * Sync enrolment with Moodle
    * Added my courses tab in Woocommerce My Account
    * Added Student Central shortcode

= 0.7.0 =

    * Syncing users wth Moodle
    * Fixing bugs

= 0.6.0 =

    * Syncing course category wth Moodle
    * Syncing courses with Moodle

= 0.5.0 =

    * Added option for setup auto enrolment

= 0.4.0 =

    * Created enrolment by Woocommerce checkout process
    * Saving enrolment in draft status

= 0.3.1 =

    * Created enrollment metabox
    * Created simple enrolment process
    * Added enrolment info in metabox

= 0.3.0 =

    * Created enrolment Post type

= 0.2.2 =

    * Allow user define if sale course with Woocommerce
    * Integrate Course with Woocommerce
    * Added Enrolment tab in course form
    * Start initial course template
    * Created Course product type in Woocommerce
    * Added tab with course info in product form

= 0.1.2 =

    * Created Woordle settings options
    * Added promotional tab in course form
    * Improved Woordle in admin (Create exclusive menu)
    * Improved Course form
    * Fix bug on save Courses

= 0.1.0 =

    * Init plugin core
    * Register Course post type
    * Created Course form
    * Added Course Category taxonomy
    * Created Course Category form

