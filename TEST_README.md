# Widget Company Block Plugin - Mutual of Omaha Mortgage | Take-Home Assessment

Hello! If you're getting this, we think you might make a good addition to our developer team. The purpose of this take home assessment is to get a quick view of how you work on something that is key to the role: Custom Wordpress Plugins. 

## What's in the plugin folder

We've tried to scaffold out a simple Wordpress plugin (using standard React Gutenberg through create-block) where you can focus on the development of the Company Block. You, of course, may scrap everything you see here and build it the way you are most comfortable, but we use WP-ENV in our own environment to make it quick and easy to start a fresh Wordpress install. Inside of the README.md file you'll find the setup instructions for how to run the script.

## What we're looking for

There's no perfect answer for this assessment. We want to see how you think, code, prioritize and document. Our main focus is building composable blocks that our Marketing team can implement as they build out articles, pages and more. The Company Block should be easy to use and easy to build upon and add to.

## What you're allowed to use

Anything! Use your favorite editor, library, scaffold or even Gen AI tool of choice. What matters more to us is the ability to show how you built this plugin and why you built it the way you did. Let us know what you used.

## The Objectives

Recommend Time Limit: 60 minutes - We understand you are busy, please don't spend any longer than 60 minutes on this.
Objective: Build a WordPress plugin that manages widget companies and allows editors to create curated, sorted lists. Submit your code on your Github and share the link with us.

# Scenario
You're building a directory of 20 widget companies with differing ratings and descriptions. As a developer, we need to hand this block off to non-technical editors who need to:

View and edit company information
Create "Recommended Lists" - curated, sorted subsets of companies
Display these lists on frontend pages

This block will exist on many different types of pages and posts. The curated list should maintain its order and be easy to sort on the Backend Editor, while looking clean on the Frontend.

## Requirements
1. Data Import (15-20 min)

Import the provided 20 companies (see data/ folder)
We've provided both CSV and JSON for ease of use
Method is up to you: admin page, wp-cli, migration script, etc.

2. Admin Interface (20-25 min)

View/edit existing companies
Create and manage "Recommended Lists" with custom sort order
Design decision: How should editors curate and sort lists? Document your UX choice.
Leave a comment/note explaining how to add NEW companies (don't build full CRUD)

3. Frontend Display (15-20 min)

Display a curated list on the frontend
Choose: Gutenberg block, shortcode, template function, or ACF block
Show: name, rating, benefits, cons, free trial badge, summary

4. Documentation (5 min)

A Brief README Markdown file explaining:

### Import process
How editors use the system
Your architecture decisions
How to add new companies




## Data Structure
Each company has:

Name (string)
Rating (integer, 1-10)
Benefits (array of 3 strings)
Cons (array of 3 strings)
Has Free Trial (boolean)
Summary (text, ~100 words)


### Technical Choices
You decide:

ACF or Gutenberg blocks?
Custom Post Type, custom tables, or options?
How to store/manage curated lists?
Import mechanism?

Document your tradeoffs - we want to see decision-making, not perfection.

#### Evaluation Criteria

Architecture (30%): Storage choices, data modeling, scalability
Editor UX (25%): How intuitive is list curation?
Code Quality (25%): Readable, organized, WordPress standards
Completeness (20%): Does it work end-to-end?


#### Submission

Push code to GitHub (public or private repo)
Include README with setup instructions
Send us the repo link
Optional: deployed demo link

## Submission

1. Push your code to GitHub (public or private repo)
2. Update this README with your implementation details
3. Send us the repository link
4. Optional: Include a deployed demo link

## Your Implementation

_After completing the assessment, please document your implementation here:_

### Import Process
_Describe how you implemented the data import and why you chose that approach_
Created admin page where editors can click a button to import companies
I thought this is easier for editors than something like wp-cli

### Architecture Decisions
_Explain your choices for data storage, list management, and frontend display_
Decided to use custom post types (companies, list) and postmeta(company data, companies in list) to leverage WP built in functions
Frontend I used a shortcode because I'm not too familiar with the custom block creation, and I was tight on time

### Editor Workflow
_Brief guide on how editors use your system to create and manage recommended lists_
Editors can go to the import page click a button and the companies are imported
Editors can edit created companies and the meta data in the edit screen
Editors can create and edit recommended lists in the edit screen as well, they can check a box to include or exclude companys from list and drag and drop for sorting

### How to Add New Companies and the Block
Use admin add post under companies menu
to use the shortcode its [recommended_list id=(list_id)]

### Tradeoffs and Considerations
_Discuss any tradeoffs you made and what you would improve with more time_
used a shortcode bc of time but I think a custom block would be way easier for non technical editors to use
used meta fields like 'benefit_1', 'benefit_2', 'benefit_3', for cons but there is probably a better way to set that up in case there is more than 3 benefits
could implement a file upload for bulk import
