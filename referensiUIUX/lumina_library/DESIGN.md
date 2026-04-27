---
name: Lumina Library
colors:
  surface: '#f8f9ff'
  surface-dim: '#cbdbf5'
  surface-bright: '#f8f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#eff4ff'
  surface-container: '#e5eeff'
  surface-container-high: '#dce9ff'
  surface-container-highest: '#d3e4fe'
  on-surface: '#0b1c30'
  on-surface-variant: '#464555'
  inverse-surface: '#213145'
  inverse-on-surface: '#eaf1ff'
  outline: '#777587'
  outline-variant: '#c7c4d8'
  surface-tint: '#4d44e3'
  primary: '#3525cd'
  on-primary: '#ffffff'
  primary-container: '#4f46e5'
  on-primary-container: '#dad7ff'
  inverse-primary: '#c3c0ff'
  secondary: '#565e74'
  on-secondary: '#ffffff'
  secondary-container: '#dae2fd'
  on-secondary-container: '#5c647a'
  tertiary: '#684000'
  on-tertiary: '#ffffff'
  tertiary-container: '#885500'
  on-tertiary-container: '#ffd4a4'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#e2dfff'
  primary-fixed-dim: '#c3c0ff'
  on-primary-fixed: '#0f0069'
  on-primary-fixed-variant: '#3323cc'
  secondary-fixed: '#dae2fd'
  secondary-fixed-dim: '#bec6e0'
  on-secondary-fixed: '#131b2e'
  on-secondary-fixed-variant: '#3f465c'
  tertiary-fixed: '#ffddb8'
  tertiary-fixed-dim: '#ffb95f'
  on-tertiary-fixed: '#2a1700'
  on-tertiary-fixed-variant: '#653e00'
  background: '#f8f9ff'
  on-background: '#0b1c30'
  surface-variant: '#d3e4fe'
typography:
  h1:
    fontFamily: Inter
    fontSize: 48px
    fontWeight: '700'
    lineHeight: '1.2'
    letterSpacing: -0.02em
  h2:
    fontFamily: Inter
    fontSize: 36px
    fontWeight: '600'
    lineHeight: '1.2'
    letterSpacing: -0.01em
  h3:
    fontFamily: Inter
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.3'
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.5'
  label-caps:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: '1'
    letterSpacing: 0.05em
  button:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '500'
    lineHeight: '1'
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  xs: 4px
  sm: 12px
  md: 24px
  lg: 48px
  xl: 80px
  container-max: 1280px
  gutter: 24px
---

## Brand & Style

This design system is built upon the concept of "Intellectual Modernism." It balances the high-trust authority of a traditional academic institution with the frictionless efficiency of modern digital interfaces. The brand personality is scholarly yet accessible, evoking a sense of discovery and organized knowledge.

The visual style leans into **Minimalism** with a **Corporate / Modern** structure. It utilizes generous whitespace to reduce cognitive load during study sessions. To avoid appearing sterile, the design incorporates a "Knowledge Texture"—subtle, low-opacity dot grids and geometric patterns inspired by architectural blueprints and book stacks. These patterns appear sparingly in the background of headers or as container accents to provide a tactile, paper-like depth.

## Colors

The palette is anchored by **Primary Indigo**, used for interactive elements, progress indicators, and primary branding. This is grounded by a **Deep Slate** foundation, which provides the necessary gravitas and high-contrast legibility for long-form reading.

**Amber** serves as the functional accent color, specifically reserved for "moments of achievement" and curated highlights—such as featured book badges, certification icons, and notification pings. 

The background should remain predominantly off-white or very light gray to minimize eye strain, while Slate is used for sidebars and navigation footers to create a clear structural hierarchy.

## Typography

This design system utilizes **Inter** exclusively to ensure maximum readability across technical and literary content. The typographic scale is optimized for information density without sacrificing clarity. 

Headlines use a tighter letter-spacing and heavier weights to feel authoritative. Body text uses a generous line-height to facilitate "deep reading" sessions. Labels and metadata (e.g., author names, ISBNs) should utilize the `label-caps` style to distinguish secondary information from primary content.

## Layout & Spacing

The layout follows a **Fixed Grid** model for the primary content area, ensuring that text line-lengths remain optimal for reading. On desktop, a 12-column grid is used with a maximum width of 1280px.

A strict 8px rhythm governs all vertical and horizontal spacing. Internal card padding is set to `md` (24px) to ensure content feels breathable. Section-level vertical margins should use `lg` (48px) to create a clear visual distinction between different categories of knowledge.

## Elevation & Depth

Visual hierarchy is achieved through **Ambient Shadows** and tonal layering. Surfaces do not use harsh borders; instead, they rely on soft, multi-layered shadows that suggest the physical weight of a book.

- **Level 1 (Base):** Content cards. A very subtle shadow with a 4px blur, primarily to lift the element off the background.
- **Level 2 (Hover):** Interactive states. The shadow expands to 12px blur with a slight indigo tint to signal interactivity.
- **Level 3 (Modals/Overlays):** Significant depth with a 24px blur, used for reading views or search overlays.

Semi-transparent backdrops (backdrop-blur) are used for global navigation bars to maintain a sense of context while scrolling through large catalogs.

## Shapes

The shape language reflects the "Professional" style through the use of **Rounded** corners. Standard UI elements like buttons and input fields utilize a 0.5rem (8px) radius. 

Large containers and book cover cards use the `rounded-lg` (1rem) setting to feel approachable. Achievement badges and certain educational chips use a full pill-shape to distinguish them from standard functional buttons. This subtle variation in corner radius helps users subconsciously categorize elements between "tools" (standard rounded) and "milestones" (pill-shaped).

## Components

### Buttons & Inputs
Buttons feature solid Indigo fills for primary actions and Slate outlines for secondary actions. Input fields use a light gray stroke that thickens and changes to Indigo on focus, accompanied by a subtle inner glow.

### Information Cards
The core of the system. Cards must include a clear hierarchy: a "cover image" area at the top, followed by a `label-caps` category, an `h3` title, and a `body-md` description. Shadows are used to indicate "clickable" cards.

### Education Badges
Small, pill-shaped components using the Amber accent color. These are placed in the top-right corner of cards or next to headers to denote "Featured," "Verified Source," or "New Course."

### Search & Filters
The search bar is a high-visibility component with a soft shadow and a leading icon. Filtering chips are used below the search bar to allow quick navigation through categories like "Science," "History," or "Literature."

### Progress Indicators
Thin, horizontal bars using a Primary Indigo fill on a Slate-100 background, used to track reading progress or course completion.