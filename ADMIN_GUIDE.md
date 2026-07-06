# Pesaro Website - Admin Panel Guide

## How to Manage Dynamic Content

This guide explains how every section of the Pesaro website is fully dynamic and can be managed through the Filament admin panel.

---

## Table of Contents

1. [Accessing the Admin Panel](#accessing-the-admin-panel)
2. [Page Builder System](#page-builder-system)
3. [Available Content Types](#available-content-types)
4. [Managing Each Section](#managing-each-section)
5. [Available Page Blocks](#available-page-blocks)

---

## Accessing the Admin Panel

**URL:** `http://your-domain.com/admin`

**Login:** Use your admin credentials to access the Filament admin panel.

---

## Page Builder System

The Pesaro website uses a **block-based page builder** system. This means:

- Each page is made up of individual **blocks** (sections)
- You can add, remove, reorder, and configure blocks
- Each block has its own settings and content
- **English and Arabic versions can have different blocks**

### How It Works

1. Go to **Content > Pages** in the admin panel
2. Edit or create a page
3. In the "Page Blocks" section, click **"Add Block"**
4. Choose the type of block you want (Hero, Services Grid, etc.)
5. Fill in the block's settings
6. Drag to reorder blocks
7. Click **Save**

---

## Available Content Types

### 1. Pages (Main Content Builder)
**Location:** Content > Pages

**Purpose:** Build any page using blocks

**Fields:**
- Title (translatable)
- Slug (URL-friendly name, translatable)
- Blocks (page builder - different per language)
- SEO Title
- SEO Description
- Published At (schedule publishing)

**How to Use:**
- Create pages like Home, About Us, Contact, etc.
- Each language can have completely different content/blocks
- Use the language switcher at the top to edit EN or AR version

---

### 2. Services
**Location:** Content > Services

**Purpose:** Manage your interior design services

**Fields:**
- Title (translatable)
- Slug (translatable)
- Short Description (translatable)
- Body / Full Description (translatable, WYSIWYG editor)
- Hero Image (main service image)
- Published At
- Sort Order (for display order)

**How to Use:**
- Add services like "Kitchens", "Interior Design", "Decoration"
- Upload hero image for each service
- Write detailed descriptions
- Services automatically appear in the Services Grid block

**Display:**
- Services Index: `/en/services` or `/ar/services`
- Service Detail: `/en/services/{slug}` or `/ar/services/{slug}`

---

### 3. Blog Posts
**Location:** Content > Blog Posts

**Purpose:** Manage news and blog articles

**Fields:**
- Title (translatable)
- Slug (translatable)
- Excerpt (short summary, translatable)
- Body (full content, translatable, WYSIWYG editor)
- Featured Image
- Published At
- Sort Order

**How to Use:**
- Create blog posts and news articles
- Upload featured image
- Write content with rich text editor
- Posts automatically appear in News Grid block

**Display:**
- Blog Index: `/en/blog` or `/ar/blog`
- Blog Detail: `/en/blog/{slug}` or `/ar/blog/{slug}`

---

### 4. Testimonials
**Location:** Content > Testimonials

**Purpose:** Manage customer testimonials/reviews

**Fields:**
- Client Name (translatable)
- Client Title/Position (translatable)
- Testimonial Text (translatable)
- Client Photo
- Rating (1-5 stars)
- Published At
- Sort Order

**How to Use:**
- Add customer testimonials
- Upload client photo
- Set rating (1-5 stars)
- Testimonials automatically appear in Testimonials Carousel block

---

### 5. FAQs
**Location:** Content > FAQs

**Purpose:** Manage frequently asked questions

**Fields:**
- Question (translatable)
- Answer (translatable, WYSIWYG editor)
- Published At
- Sort Order

**How to Use:**
- Add questions and answers
- Use rich text formatting in answers
- Control order with sort_order field

**Display:**
- FAQ Page: `/en/faqs` or `/ar/faqs`

---

### 6. Gallery Images
**Location:** Content > Gallery Images

**Purpose:** Manage project/portfolio images

**Fields:**
- Title (translatable)
- Description (translatable)
- Image (upload)
- Show in Footer (checkbox)
- Published At
- Sort Order

**How to Use:**
- Upload project images
- Add titles and descriptions
- Check "Show in Footer" to display in footer gallery (max 9 images)
- Gallery images appear in Gallery Grid block

**Display:**
- Gallery Page: `/en/gallery` or `/ar/gallery`
- Footer: Shows 9 most recent images with "Show in Footer" checked

---

### 7. Form Submissions
**Location:** Content > Form Submissions

**Purpose:** View contact form submissions

**Fields:**
- Name
- Email
- Phone
- Subject
- Message
- Status (New, In Progress, Completed)
- Created At

**How to Use:**
- View submissions from contact forms
- Mark status to track follow-ups
- Export data if needed

---

## Available Page Blocks

### 1. Hero - Home Page
**Use For:** Homepage hero section

**Settings:**
- Background Image
- Main Heading (translatable)
- Subheading (translatable)
- Button Text (translatable)
- Button Link

**Example:** Large hero banner with image, text, and CTA button

---

### 2. Hero - Inner Page
**Use For:** Hero section for inner pages

**Settings:**
- Background Image
- Page Title (translatable)
- Breadcrumb (auto-generated based on page hierarchy)

**Example:** Smaller hero for About Us, Services pages, etc.

---

### 3. About Section with Benefits
**Use For:** About section with layered images and benefits list

**Settings:**
- Section Label (translatable, e.g., "About US")
- Section Title (translatable, supports HTML for styling)
- Description (translatable)
- Main Image (large background image)
- Small Image (overlapping foreground image)
- Benefits List (repeater):
  - Benefit Title (translatable)
  - Benefit Description (translatable)

**Example:** Homepage about section with company info and benefits

---

### 4. Services Grid
**Use For:** Display services in a grid

**Settings:**
- Heading (translatable)
- Subheading (translatable)
- Number of columns (2, 3, or 4)
- Limit (how many services to show)
- Button Text (optional)
- Button Link (optional)

**Data Source:** Automatically pulls from Services (published only)

---

### 5. News / Blog Grid
**Use For:** Display blog posts in a grid

**Settings:**
- Heading (translatable)
- Subheading (translatable)
- Number of columns (2, 3, or 4)
- Limit (how many posts to show)
- Button Text (optional)
- Button Link (optional)

**Data Source:** Automatically pulls from Blog Posts (published only)

---

### 6. Testimonials Carousel
**Use For:** Customer testimonials slider

**Settings:**
- Heading (translatable)
- Subheading (translatable)
- Auto-play (yes/no)
- Auto-play Speed (milliseconds)

**Data Source:** Automatically pulls from Testimonials (published only)

---

### 7. Gallery Grid
**Use For:** Display gallery images

**Settings:**
- Heading (translatable)
- Subheading (translatable)
- Number of columns (2, 3, or 4)
- Limit (how many images to show)
- Lightbox enabled (yes/no)

**Data Source:** Automatically pulls from Gallery Images (published only)

---

### 8. Timeline
**Use For:** Display company history or process steps

**Settings:**
- Heading (translatable)
- Subheading (translatable)
- Timeline Items (repeater):
  - Year
  - Title (translatable)
  - Description (translatable)
  - Icon/Image (optional)

**Example:** Company milestones, project phases, process steps

---

### 9. Contact Form
**Use For:** Add a contact form anywhere

**Settings:**
- Heading (translatable)
- Subheading (translatable)
- Form Fields (customize which fields to show):
  - Name (required)
  - Email (required)
  - Phone (optional)
  - Subject (optional)
  - Message (required)
- Success Message (translatable)
- Submit Button Text (translatable)

**Submissions:** Stored in Form Submissions

---

### 10. Rich Text
**Use For:** Free-form content with text, images, etc.

**Settings:**
- Content (translatable, WYSIWYG editor with images, formatting, etc.)

**Example:** About us text, policy pages, any custom content

---

### 11. Section Heading
**Use For:** Add a heading/title between sections

**Settings:**
- Heading (translatable)
- Subheading (translatable)
- Alignment (left, center, right)
- Decorative Line (yes/no)

**Example:** Separators between page sections

---

## Step-by-Step: Creating a Dynamic Page

### Example: Creating an "About Us" Page

1. **Navigate to Pages**
   - Click "Content" in sidebar
   - Click "Pages"
   - Click "New Page"

2. **Add Basic Info (English)**
   - Title: "About Us"
   - Slug: "about-us" (auto-generated)

3. **Add Blocks**

   **Block 1: Hero - Inner Page**
   - Click "Add Block" > "Hero - Inner Page"
   - Upload background image
   - Page Title: "About Pesaro"

   **Block 2: Section Heading**
   - Click "Add Block" > "Section Heading"
   - Heading: "Our Story"
   - Subheading: "Building dreams since 2010"

   **Block 3: Rich Text**
   - Click "Add Block" > "Rich Text"
   - Write your about us content with formatting

   **Block 4: Timeline**
   - Click "Add Block" > "Timeline"
   - Heading: "Our Journey"
   - Add timeline items (2010, 2015, 2020, etc.)

   **Block 5: Testimonials Carousel**
   - Click "Add Block" > "Testimonials Carousel"
   - Heading: "What Our Clients Say"

4. **Switch to Arabic**
   - Click language switcher at top
   - Select "Arabic"
   - Translate title: "من نحن"
   - Translate slug: "من-نحن"
   - Add/translate blocks (can be different from English!)

5. **SEO Settings**
   - Add SEO Title
   - Add SEO Description

6. **Publish**
   - Set "Published At" to current date/time
   - Click "Save"

7. **View Result**
   - English: `/en/about-us`
   - Arabic: `/ar/من-نحن`

---

## Tips for Managing Dynamic Content

### Best Practices

1. **Always Publish**
   - Set "Published At" date to make content visible
   - Leave empty to keep as draft

2. **Use Sort Order**
   - Lower numbers appear first
   - Use increments of 10 (10, 20, 30) to allow easy reordering

3. **Optimize Images**
   - Use WebP format when possible
   - Recommended sizes:
     - Hero images: 1920x1080px
     - Service cards: 800x600px
     - Gallery images: 1200x900px
     - Thumbnails: 400x300px

4. **Bilingual Content**
   - Always fill both English and Arabic versions
   - Each language can have different blocks/content
   - Test both languages after publishing

5. **SEO**
   - Always add SEO Title (50-60 characters)
   - Always add SEO Description (150-160 characters)
   - Use descriptive slugs

---

## Common Scenarios

### How do I change the homepage?

1. Go to **Content > Pages**
2. Find the page with slug "home" or "/"
3. Edit the page
4. Add/remove/reorder blocks as needed
5. Save

### How do I add a new service?

1. Go to **Content > Services**
2. Click "New Service"
3. Fill in title, description
4. Upload hero image
5. Set "Published At"
6. Save
7. Service automatically appears in Services Grid blocks

### How do I change footer gallery images?

1. Go to **Content > Gallery Images**
2. For each image you want in footer:
   - Edit image
   - Check "Show in Footer"
   - Set sort order
3. Save
4. Footer shows 9 most recent images with "Show in Footer" checked

### How do I change the order of services/blog posts?

1. Edit the item
2. Change "Sort Order" field
3. Lower numbers appear first (e.g., 10, 20, 30)
4. Save

### Can English and Arabic have different page layouts?

**Yes!** The blocks are translatable, which means:
- English can have 5 blocks
- Arabic can have 3 completely different blocks
- Each language is independent

---

## Need Help?

- All content is in the **Content** menu group
- Use the language switcher to toggle EN/AR editing
- Preview before publishing
- Changes are immediate after saving

---

## Summary

✅ **Everything is dynamic** - No code changes needed
✅ **Fully bilingual** - Independent EN/AR content
✅ **Block-based** - Build pages like LEGO blocks
✅ **Media library** - Upload and manage all images
✅ **SEO-friendly** - Built-in SEO fields
✅ **Draft/Publish** - Control when content goes live

---

**Admin Panel Access:** `/admin`

For technical support, contact your developer.
