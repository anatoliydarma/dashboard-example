<style>
    .page-break {
        page-break-after: always;
    }

    body {
        font-family: 'Inter';
    }

    /*
    ! tailwindcss v3.0.24 | MIT License | https://tailwindcss.com
    */
    /*
    1. Prevent padding and border from affecting element width. (https://github.com/mozdevs/cssremedy/issues/4)
    2. Allow adding a border to an element by just adding a border-width. (https://github.com/tailwindcss/tailwindcss/pull/116)
    */

    *,
    ::before,
    ::after {
        box-sizing: border-box;
        /* 1 */
        border-width: 0;
        /* 2 */
        border-style: solid;
        /* 2 */
        border-color: #e5e7eb;
        /* 2 */
    }

    ::before,
    ::after {
        --tw-content: "";
    }

    /*
    1. Use a consistent sensible line-height in all browsers.
    2. Prevent adjustments of font size after orientation changes in iOS.
    3. Use a more readable tab size.
    4. Use the user's configured `sans` font-family by default.
    */

    html {
        line-height: 1.5;
        /* 1 */
        -webkit-text-size-adjust: 100%;
        /* 2 */
        -moz-tab-size: 4;
        /* 3 */
        -o-tab-size: 4;
        tab-size: 4;
        /* 3 */
        font-family: Inter var, ui-sans-serif, system-ui, -apple-system,
            BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial,
            "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji",
            "Segoe UI Symbol", "Noto Color Emoji";
        /* 4 */
    }

    /*
    1. Remove the margin in all browsers.
    2. Inherit line-height from `html` so users can set them as a class directly on the `html` element.
    */

    body {
        margin: 0;
        /* 1 */
        line-height: inherit;
        /* 2 */
    }

    /*
    1. Add the correct height in Firefox.
    2. Correct the inheritance of border color in Firefox. (https://bugzilla.mozilla.org/show_bug.cgi?id=190655)
    3. Ensure horizontal rules are visible by default.
    */

    hr {
        height: 0;
        /* 1 */
        color: inherit;
        /* 2 */
        border-top-width: 1px;
        /* 3 */
    }

    /*
    Add the correct text decoration in Chrome, Edge, and Safari.
    */

    abbr:where([title]) {
        -webkit-text-decoration: underline dotted;
        text-decoration: underline dotted;
    }

    /*
    Remove the default font size and weight for headings.
    */

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-size: inherit;
        font-weight: inherit;
    }

    /*
    Reset links to optimize for opt-in styling instead of opt-out.
    */

    a {
        color: inherit;
        text-decoration: inherit;
    }

    /*
    Add the correct font weight in Edge and Safari.
    */

    b,
    strong {
        font-weight: bolder;
    }

    /*
    1. Use the user's configured `mono` font family by default.
    2. Correct the odd `em` font sizing in all browsers.
    */

    code,
    kbd,
    samp,
    pre {
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas,
            "Liberation Mono", "Courier New", monospace;
        /* 1 */
        font-size: 1em;
        /* 2 */
    }

    /*
    Add the correct font size in all browsers.
    */

    small {
        font-size: 80%;
    }

    /*
    Prevent `sub` and `sup` elements from affecting the line height in all browsers.
    */

    sub,
    sup {
        font-size: 75%;
        line-height: 0;
        position: relative;
        vertical-align: baseline;
    }

    sub {
        bottom: -0.25em;
    }

    sup {
        top: -0.5em;
    }

    /*
    1. Remove text indentation from table contents in Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=999088, https://bugs.webkit.org/show_bug.cgi?id=201297)
    2. Correct table border color inheritance in all Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=935729, https://bugs.webkit.org/show_bug.cgi?id=195016)
    3. Remove gaps between table borders by default.
    */

    table {
        text-indent: 0;
        /* 1 */
        border-color: inherit;
        /* 2 */
        border-collapse: collapse;
        /* 3 */
    }

    /*
    1. Change the font styles in all browsers.
    2. Remove the margin in Firefox and Safari.
    3. Remove default padding in all browsers.
    */

    button,
    input,
    optgroup,
    select,
    textarea {
        font-family: inherit;
        /* 1 */
        font-size: 100%;
        /* 1 */
        line-height: inherit;
        /* 1 */
        color: inherit;
        /* 1 */
        margin: 0;
        /* 2 */
        padding: 0;
        /* 3 */
    }

    /*
    Remove the inheritance of text transform in Edge and Firefox.
    */

    button,
    select {
        text-transform: none;
    }

    /*
    1. Correct the inability to style clickable types in iOS and Safari.
    2. Remove default button styles.
    */

    button,
    [type="button"],
    [type="reset"],
    [type="submit"] {
        -webkit-appearance: button;
        /* 1 */
        background-color: transparent;
        /* 2 */
        background-image: none;
        /* 2 */
    }

    /*
    Use the modern Firefox focus style for all focusable elements.
    */

    :-moz-focusring {
        outline: auto;
    }

    /*
    Remove the additional `:invalid` styles in Firefox. (https://github.com/mozilla/gecko-dev/blob/2f9eacd9d3d995c937b4251a5557d95d494c9be1/layout/style/res/forms.css#L728-L737)
    */

    :-moz-ui-invalid {
        box-shadow: none;
    }

    /*
    Add the correct vertical alignment in Chrome and Firefox.
    */

    progress {
        vertical-align: baseline;
    }

    /*
    Correct the cursor style of increment and decrement buttons in Safari.
    */

    ::-webkit-inner-spin-button,
    ::-webkit-outer-spin-button {
        height: auto;
    }

    /*
    1. Correct the odd appearance in Chrome and Safari.
    2. Correct the outline style in Safari.
    */

    [type="search"] {
        -webkit-appearance: textfield;
        /* 1 */
        outline-offset: -2px;
        /* 2 */
    }

    /*
    Remove the inner padding in Chrome and Safari on macOS.
    */

    ::-webkit-search-decoration {
        -webkit-appearance: none;
    }

    /*
    1. Correct the inability to style clickable types in iOS and Safari.
    2. Change font properties to `inherit` in Safari.
    */

    ::-webkit-file-upload-button {
        -webkit-appearance: button;
        /* 1 */
        font: inherit;
        /* 2 */
    }

    /*
    Add the correct display in Chrome and Safari.
    */

    summary {
        display: list-item;
    }

    /*
    Removes the default spacing and border for appropriate elements.
    */

    blockquote,
    dl,
    dd,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    hr,
    figure,
    p,
    pre {
        margin: 0;
    }

    fieldset {
        margin: 0;
        padding: 0;
    }

    legend {
        padding: 0;
    }

    ol,
    ul,
    menu {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    /*
    Prevent resizing textareas horizontally by default.
    */

    textarea {
        resize: vertical;
    }

    /*
    1. Reset the default placeholder opacity in Firefox. (https://github.com/tailwindlabs/tailwindcss/issues/3300)
    2. Set the default placeholder color to the user's configured gray 400 color.
    */

    input::-moz-placeholder,
    textarea::-moz-placeholder {
        opacity: 1;
        /* 1 */
        color: #9ca3af;
        /* 2 */
    }

    input:-ms-input-placeholder,
    textarea:-ms-input-placeholder {
        opacity: 1;
        /* 1 */
        color: #9ca3af;
        /* 2 */
    }

    input::placeholder,
    textarea::placeholder {
        opacity: 1;
        /* 1 */
        color: #9ca3af;
        /* 2 */
    }

    /*
    Set the default cursor for buttons.
    */

    button,
    [role="button"] {
        cursor: pointer;
    }

    /*
    Make sure disabled buttons don't get the pointer cursor.
    */
    :disabled {
        cursor: default;
    }

    /*
    1. Make replaced elements `display: block` by default. (https://github.com/mozdevs/cssremedy/issues/14)
    2. Add `vertical-align: middle` to align replaced elements more sensibly by default. (https://github.com/jensimmons/cssremedy/issues/14#issuecomment-634934210)
    This can trigger a poorly considered lint error in some tools but is included by design.
    */

    img,
    svg,
    video,
    canvas,
    audio,
    iframe,
    embed,
    object {
        display: block;
        /* 1 */
        vertical-align: middle;
        /* 2 */
    }

    /*
    Constrain images and videos to the parent width and preserve their intrinsic aspect ratio. (https://github.com/mozdevs/cssremedy/issues/14)
    */

    img,
    video {
        max-width: 100%;
        height: auto;
    }

    /*
    Ensure the default browser behavior of the `hidden` attribute.
    */

    [hidden] {
        display: none;
    }

    [type="text"],
    [type="email"],
    [type="url"],
    [type="password"],
    [type="number"],
    [type="date"],
    [type="datetime-local"],
    [type="month"],
    [type="search"],
    [type="tel"],
    [type="time"],
    [type="week"],
    [multiple],
    textarea,
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-color: #fff;
        border-color: #6b7280;
        border-width: 1px;
        border-radius: 0px;
        padding-top: 0.5rem;
        padding-right: 0.75rem;
        padding-bottom: 0.5rem;
        padding-left: 0.75rem;
        font-size: 1rem;
        line-height: 1.5rem;
        --tw-shadow: 0 0 #0000;
    }

    [type="text"]:focus,
    [type="email"]:focus,
    [type="url"]:focus,
    [type="password"]:focus,
    [type="number"]:focus,
    [type="date"]:focus,
    [type="datetime-local"]:focus,
    [type="month"]:focus,
    [type="search"]:focus,
    [type="tel"]:focus,
    [type="time"]:focus,
    [type="week"]:focus,
    [multiple]:focus,
    textarea:focus,
    select:focus {
        outline: 2px solid transparent;
        outline-offset: 2px;
        --tw-ring-inset: var(--tw-empty,
                /*!*/
                /*!*/
            );
        --tw-ring-offset-width: 0px;
        --tw-ring-offset-color: #fff;
        --tw-ring-color: #2563eb;
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow),
            var(--tw-shadow);
        border-color: #2563eb;
    }

    input::-moz-placeholder,
    textarea::-moz-placeholder {
        color: #6b7280;
        opacity: 1;
    }

    input:-ms-input-placeholder,
    textarea:-ms-input-placeholder {
        color: #6b7280;
        opacity: 1;
    }

    input::placeholder,
    textarea::placeholder {
        color: #6b7280;
        opacity: 1;
    }

    ::-webkit-datetime-edit-fields-wrapper {
        padding: 0;
    }

    ::-webkit-date-and-time-value {
        min-height: 1.5em;
    }

    ::-webkit-datetime-edit,
    ::-webkit-datetime-edit-year-field,
    ::-webkit-datetime-edit-month-field,
    ::-webkit-datetime-edit-day-field,
    ::-webkit-datetime-edit-hour-field,
    ::-webkit-datetime-edit-minute-field,
    ::-webkit-datetime-edit-second-field,
    ::-webkit-datetime-edit-millisecond-field,
    ::-webkit-datetime-edit-meridiem-field {
        padding-top: 0;
        padding-bottom: 0;
    }

    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
        print-color-adjust: exact;
    }

    [multiple] {
        background-image: initial;
        background-position: initial;
        background-repeat: unset;
        background-size: initial;
        padding-right: 0.75rem;
        -webkit-print-color-adjust: unset;
        color-adjust: unset;
        print-color-adjust: unset;
    }

    [type="checkbox"],
    [type="radio"] {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        padding: 0;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
        print-color-adjust: exact;
        display: inline-block;
        vertical-align: middle;
        background-origin: border-box;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        flex-shrink: 0;
        height: 1rem;
        width: 1rem;
        color: #2563eb;
        background-color: #fff;
        border-color: #6b7280;
        border-width: 1px;
        --tw-shadow: 0 0 #0000;
    }

    [type="checkbox"] {
        border-radius: 0px;
    }

    [type="radio"] {
        border-radius: 100%;
    }

    [type="checkbox"]:focus,
    [type="radio"]:focus {
        outline: 2px solid transparent;
        outline-offset: 2px;
        --tw-ring-inset: var(--tw-empty,
                /*!*/
                /*!*/
            );
        --tw-ring-offset-width: 2px;
        --tw-ring-offset-color: #fff;
        --tw-ring-color: #2563eb;
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow),
            var(--tw-shadow);
    }

    [type="checkbox"]:checked,
    [type="radio"]:checked {
        border-color: transparent;
        background-color: currentColor;
        background-size: 100% 100%;
        background-position: center;
        background-repeat: no-repeat;
    }

    [type="checkbox"]:checked {
        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
    }

    [type="radio"]:checked {
        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
    }

    [type="checkbox"]:checked:hover,
    [type="checkbox"]:checked:focus,
    [type="radio"]:checked:hover,
    [type="radio"]:checked:focus {
        border-color: transparent;
        background-color: currentColor;
    }

    [type="checkbox"]:indeterminate {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 16 16'%3e%3cpath stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 8h8'/%3e%3c/svg%3e");
        border-color: transparent;
        background-color: currentColor;
        background-size: 100% 100%;
        background-position: center;
        background-repeat: no-repeat;
    }

    [type="checkbox"]:indeterminate:hover,
    [type="checkbox"]:indeterminate:focus {
        border-color: transparent;
        background-color: currentColor;
    }

    [type="file"] {
        background: unset;
        border-color: inherit;
        border-width: 0;
        border-radius: 0;
        padding: 0;
        font-size: unset;
        line-height: inherit;
    }

    [type="file"]:focus {
        outline: 1px solid ButtonText;
        outline: 1px auto -webkit-focus-ring-color;
    }

    *,
    ::before,
    ::after {
        --tw-translate-x: 0;
        --tw-translate-y: 0;
        --tw-rotate: 0;
        --tw-skew-x: 0;
        --tw-skew-y: 0;
        --tw-scale-x: 1;
        --tw-scale-y: 1;
        --tw-pan-x: ;
        --tw-pan-y: ;
        --tw-pinch-zoom: ;
        --tw-scroll-snap-strictness: proximity;
        --tw-ordinal: ;
        --tw-slashed-zero: ;
        --tw-numeric-figure: ;
        --tw-numeric-spacing: ;
        --tw-numeric-fraction: ;
        --tw-ring-inset: ;
        --tw-ring-offset-width: 0px;
        --tw-ring-offset-color: #fff;
        --tw-ring-color: rgb(59 130 246 / 0.5);
        --tw-ring-offset-shadow: 0 0 #0000;
        --tw-ring-shadow: 0 0 #0000;
        --tw-shadow: 0 0 #0000;
        --tw-shadow-colored: 0 0 #0000;
        --tw-blur: ;
        --tw-brightness: ;
        --tw-contrast: ;
        --tw-grayscale: ;
        --tw-hue-rotate: ;
        --tw-invert: ;
        --tw-saturate: ;
        --tw-sepia: ;
        --tw-drop-shadow: ;
        --tw-backdrop-blur: ;
        --tw-backdrop-brightness: ;
        --tw-backdrop-contrast: ;
        --tw-backdrop-grayscale: ;
        --tw-backdrop-hue-rotate: ;
        --tw-backdrop-invert: ;
        --tw-backdrop-opacity: ;
        --tw-backdrop-saturate: ;
        --tw-backdrop-sepia: ;
    }

    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border-width: 0;
    }

    .pointer-events-none {
        pointer-events: none;
    }

    .pointer-events-auto {
        pointer-events: auto;
    }

    .invisible {
        visibility: hidden;
    }

    .fixed {
        position: fixed;
    }

    .absolute {
        position: absolute;
    }

    .relative {
        position: relative;
    }

    .inset-0 {
        top: 0px;
        right: 0px;
        bottom: 0px;
        left: 0px;
    }

    .inset-x-0 {
        left: 0px;
        right: 0px;
    }

    .inset-y-0 {
        top: 0px;
        bottom: 0px;
    }

    .left-0 {
        left: 0px;
    }

    .right-0 {
        right: 0px;
    }

    .top-0 {
        top: 0px;
    }

    .bottom-0 {
        bottom: 0px;
    }

    .top-2 {
        top: 0.5rem;
    }

    .right-4 {
        right: 1rem;
    }

    .left-1\/2 {
        left: 50%;
    }

    .right-2 {
        right: 0.5rem;
    }

    .top-2\.5 {
        top: 0.625rem;
    }

    .z-0 {
        z-index: 0;
    }

    .z-40 {
        z-index: 40;
    }

    .z-50 {
        z-index: 50;
    }

    .z-60 {
        z-index: 60;
    }

    .z-10 {
        z-index: 10;
    }

    .col-span-6 {
        grid-column: span 6 / span 6;
    }

    .col-span-3 {
        grid-column: span 3 / span 3;
    }

    .m-auto {
        margin: auto;
    }

    .mx-auto {
        margin-left: auto;
        margin-right: auto;
    }

    .-mx-4 {
        margin-left: -1rem;
        margin-right: -1rem;
    }

    .-my-2 {
        margin-top: -0.5rem;
        margin-bottom: -0.5rem;
    }

    .-ml-px {
        margin-left: -1px;
    }

    .mt-2 {
        margin-top: 0.5rem;
    }

    .ml-3 {
        margin-left: 0.75rem;
    }

    .mt-1 {
        margin-top: 0.25rem;
    }

    .mt-5 {
        margin-top: 1.25rem;
    }

    .mt-3 {
        margin-top: 0.75rem;
    }

    .mt-4 {
        margin-top: 1rem;
    }

    .mr-1 {
        margin-right: 0.25rem;
    }

    .ml-2 {
        margin-left: 0.5rem;
    }

    .-mr-0\.5 {
        margin-right: -0.125rem;
    }

    .-mr-0 {
        margin-right: -0px;
    }

    .mt-8 {
        margin-top: 2rem;
    }

    .-mr-2 {
        margin-right: -0.5rem;
    }

    .mt-6 {
        margin-top: 1.5rem;
    }

    .ml-4 {
        margin-left: 1rem;
    }

    .-mb-1 {
        margin-bottom: -0.25rem;
    }

    .mb-4 {
        margin-bottom: 1rem;
    }

    .ml-5 {
        margin-left: 1.25rem;
    }

    .mr-2 {
        margin-right: 0.5rem;
    }

    .block {
        display: block;
    }

    .inline-block {
        display: inline-block;
    }

    .flex {
        display: flex;
    }

    .inline-flex {
        display: inline-flex;
    }

    .table {
        display: table;
    }

    .grid {
        display: grid;
    }

    .contents {
        display: contents;
    }

    .hidden {
        display: none;
    }

    .h-4 {
        height: 1rem;
    }

    .h-6 {
        height: 1.5rem;
    }

    .h-screen {
        height: 100vh;
    }

    .h-40 {
        height: 10rem;
    }

    .h-5 {
        height: 1.25rem;
    }

    .h-full {
        height: 100%;
    }

    .h-16 {
        height: 4rem;
    }

    .h-9 {
        height: 2.25rem;
    }

    .h-20 {
        height: 5rem;
    }

    .h-96 {
        height: 24rem;
    }

    .h-2 {
        height: 0.5rem;
    }

    .max-h-60 {
        max-height: 15rem;
    }

    .min-h-screen {
        min-height: 100vh;
    }

    .w-28 {
        width: 7rem;
    }

    .w-40 {
        width: 10rem;
    }

    .w-full {
        width: 100%;
    }

    .w-48 {
        width: 12rem;
    }

    .w-4 {
        width: 1rem;
    }

    .w-6 {
        width: 1.5rem;
    }

    .w-screen {
        width: 100vw;
    }

    .w-5 {
        width: 1.25rem;
    }

    .w-3 {
        width: 0.75rem;
    }

    .w-12 {
        width: 3rem;
    }

    .w-20 {
        width: 5rem;
    }

    .w-11 {
        width: 2.75rem;
    }

    .w-auto {
        width: auto;
    }

    .w-56 {
        width: 14rem;
    }

    .w-16 {
        width: 4rem;
    }

    .w-24 {
        width: 6rem;
    }

    .w-6\/12 {
        width: 50%;
    }

    .w-7\/12 {
        width: 58.333333%;
    }

    .w-5\/12 {
        width: 41.666667%;
    }

    .w-2 {
        width: 0.5rem;
    }

    .min-w-full {
        min-width: 100%;
    }

    .max-w-md {
        max-width: 28rem;
    }

    .max-w-screen-xl {
        max-width: 1280px;
    }

    .max-w-sm {
        max-width: 24rem;
    }

    .max-w-7xl {
        max-width: 80rem;
    }

    .max-w-6xl {
        max-width: 72rem;
    }

    .max-w-xs {
        max-width: 20rem;
    }

    .flex-1 {
        flex: 1 1 0%;
    }

    .flex-shrink-0 {
        flex-shrink: 0;
    }

    .shrink-0 {
        flex-shrink: 0;
    }

    .origin-top-left {
        transform-origin: top left;
    }

    .origin-top-right {
        transform-origin: top right;
    }

    .origin-top {
        transform-origin: top;
    }

    .translate-y-4 {
        --tw-translate-y: 1rem;
        transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    }

    .translate-y-0 {
        --tw-translate-y: 0px;
        transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    }

    .translate-y-full {
        --tw-translate-y: 100%;
        transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    }

    .translate-y-1 {
        --tw-translate-y: 0.25rem;
        transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    }

    .-translate-x-1\/2 {
        --tw-translate-x: -50%;
        transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    }

    .translate-x-5 {
        --tw-translate-x: 1.25rem;
        transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    }

    .translate-x-0 {
        --tw-translate-x: 0px;
        transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    }

    .rotate-45 {
        --tw-rotate: 45deg;
        transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    }

    .scale-95 {
        --tw-scale-x: 0.95;
        --tw-scale-y: 0.95;
        transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    }

    .scale-100 {
        --tw-scale-x: 1;
        --tw-scale-y: 1;
        transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    }

    .transform {
        transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    }

    .transform-gpu {
        transform: translate3d(var(--tw-translate-x), var(--tw-translate-y), 0) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    }

    @-webkit-keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .animate-spin {
        -webkit-animation: spin 1s linear infinite;
        animation: spin 1s linear infinite;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .cursor-default {
        cursor: default;
    }

    .select-none {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .list-inside {
        list-style-position: inside;
    }

    .list-disc {
        list-style-type: disc;
    }

    .grid-cols-6 {
        grid-template-columns: repeat(6, minmax(0, 1fr));
    }

    .flex-col {
        flex-direction: column;
    }

    .items-start {
        align-items: flex-start;
    }

    .items-end {
        align-items: flex-end;
    }

    .items-center {
        align-items: center;
    }

    .justify-start {
        justify-content: flex-start;
    }

    .justify-end {
        justify-content: flex-end;
    }

    .justify-center {
        justify-content: center;
    }

    .justify-between {
        justify-content: space-between;
    }

    .gap-4 {
        gap: 1rem;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    .gap-8 {
        gap: 2rem;
    }

    .gap-1 {
        gap: 0.25rem;
    }

    .gap-6 {
        gap: 1.5rem;
    }

    .space-y-2> :not([hidden])~ :not([hidden]) {
        --tw-space-y-reverse: 0;
        margin-top: calc(0.5rem * calc(1 - var(--tw-space-y-reverse)));
        margin-bottom: calc(0.5rem * var(--tw-space-y-reverse));
    }

    .space-x-8> :not([hidden])~ :not([hidden]) {
        --tw-space-x-reverse: 0;
        margin-right: calc(2rem * var(--tw-space-x-reverse));
        margin-left: calc(2rem * calc(1 - var(--tw-space-x-reverse)));
    }

    .space-y-1> :not([hidden])~ :not([hidden]) {
        --tw-space-y-reverse: 0;
        margin-top: calc(0.25rem * calc(1 - var(--tw-space-y-reverse)));
        margin-bottom: calc(0.25rem * var(--tw-space-y-reverse));
    }

    .space-y-6> :not([hidden])~ :not([hidden]) {
        --tw-space-y-reverse: 0;
        margin-top: calc(1.5rem * calc(1 - var(--tw-space-y-reverse)));
        margin-bottom: calc(1.5rem * var(--tw-space-y-reverse));
    }

    .space-y-4> :not([hidden])~ :not([hidden]) {
        --tw-space-y-reverse: 0;
        margin-top: calc(1rem * calc(1 - var(--tw-space-y-reverse)));
        margin-bottom: calc(1rem * var(--tw-space-y-reverse));
    }

    .space-x-2> :not([hidden])~ :not([hidden]) {
        --tw-space-x-reverse: 0;
        margin-right: calc(0.5rem * var(--tw-space-x-reverse));
        margin-left: calc(0.5rem * calc(1 - var(--tw-space-x-reverse)));
    }

    .space-x-4> :not([hidden])~ :not([hidden]) {
        --tw-space-x-reverse: 0;
        margin-right: calc(1rem * var(--tw-space-x-reverse));
        margin-left: calc(1rem * calc(1 - var(--tw-space-x-reverse)));
    }

    .divide-y> :not([hidden])~ :not([hidden]) {
        --tw-divide-y-reverse: 0;
        border-top-width: calc(1px * calc(1 - var(--tw-divide-y-reverse)));
        border-bottom-width: calc(1px * var(--tw-divide-y-reverse));
    }

    .divide-slate-300> :not([hidden])~ :not([hidden]) {
        --tw-divide-opacity: 1;
        border-color: rgb(209 213 219 / var(--tw-divide-opacity));
    }

    .divide-slate-200> :not([hidden])~ :not([hidden]) {
        --tw-divide-opacity: 1;
        border-color: rgb(229 231 235 / var(--tw-divide-opacity));
    }

    .overflow-auto {
        overflow: auto;
    }

    .overflow-hidden {
        overflow: hidden;
    }

    .overflow-x-auto {
        overflow-x: auto;
    }

    .overflow-y-auto {
        overflow-y: auto;
    }

    .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .whitespace-normal {
        white-space: normal;
    }

    .whitespace-nowrap {
        white-space: nowrap;
    }

    .rounded-full {
        border-radius: 9999px;
    }

    .rounded-lg {
        border-radius: 0.5rem;
    }

    .rounded {
        border-radius: 0.25rem;
    }

    .rounded-md {
        border-radius: 0.375rem;
    }

    .rounded-l-md {
        border-top-left-radius: 0.375rem;
        border-bottom-left-radius: 0.375rem;
    }

    .rounded-r-md {
        border-top-right-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
    }

    .border {
        border-width: 1px;
    }

    .border-2 {
        border-width: 2px;
    }

    .border-b-2 {
        border-bottom-width: 2px;
    }

    .border-l-4 {
        border-left-width: 4px;
    }

    .border-b {
        border-bottom-width: 1px;
    }

    .border-t {
        border-top-width: 1px;
    }

    .border-slate-300 {
        --tw-border-opacity: 1;
        border-color: rgb(209 213 219 / var(--tw-border-opacity));
    }

    .border-red-500 {
        --tw-border-opacity: 1;
        border-color: rgb(239 68 68 / var(--tw-border-opacity));
    }

    .border-indigo-400 {
        --tw-border-opacity: 1;
        border-color: rgb(129 140 248 / var(--tw-border-opacity));
    }

    .border-transparent {
        border-color: transparent;
    }

    .border-slate-200 {
        --tw-border-opacity: 1;
        border-color: rgb(229 231 235 / var(--tw-border-opacity));
    }

    .bg-slate-50 {
        --tw-bg-opacity: 1;
        background-color: rgb(249 250 251 / var(--tw-bg-opacity));
    }

    .bg-white {
        --tw-bg-opacity: 1;
        background-color: rgb(255 255 255 / var(--tw-bg-opacity));
    }

    .bg-indigo-500 {
        --tw-bg-opacity: 1;
        background-color: rgb(99 102 241 / var(--tw-bg-opacity));
    }

    .bg-slate-500 {
        --tw-bg-opacity: 1;
        background-color: rgb(107 114 128 / var(--tw-bg-opacity));
    }

    .bg-red-500 {
        --tw-bg-opacity: 1;
        background-color: rgb(239 68 68 / var(--tw-bg-opacity));
    }

    .bg-slate-700 {
        --tw-bg-opacity: 1;
        background-color: rgb(55 65 81 / var(--tw-bg-opacity));
    }

    .bg-indigo-50 {
        --tw-bg-opacity: 1;
        background-color: rgb(238 242 255 / var(--tw-bg-opacity));
    }

    .bg-amber-100 {
        --tw-bg-opacity: 1;
        background-color: rgb(254 243 199 / var(--tw-bg-opacity));
    }

    .bg-indigo-600 {
        --tw-bg-opacity: 1;
        background-color: rgb(79 70 229 / var(--tw-bg-opacity));
    }

    .bg-green-600 {
        --tw-bg-opacity: 1;
        background-color: rgb(22 163 74 / var(--tw-bg-opacity));
    }

    .bg-slate-600 {
        --tw-bg-opacity: 1;
        background-color: rgb(75 85 99 / var(--tw-bg-opacity));
    }

    .bg-red-600 {
        --tw-bg-opacity: 1;
        background-color: rgb(220 38 38 / var(--tw-bg-opacity));
    }

    .bg-indigo-100 {
        --tw-bg-opacity: 1;
        background-color: rgb(224 231 255 / var(--tw-bg-opacity));
    }

    .\!bg-transparent {
        background-color: transparent !important;
    }

    .bg-green-500 {
        --tw-bg-opacity: 1;
        background-color: rgb(34 197 94 / var(--tw-bg-opacity));
    }

    .bg-slate-200 {
        --tw-bg-opacity: 1;
        background-color: rgb(229 231 235 / var(--tw-bg-opacity));
    }

    .bg-slate-100 {
        --tw-bg-opacity: 1;
        background-color: rgb(243 244 246 / var(--tw-bg-opacity));
    }

    .bg-slate-50 {
        --tw-bg-opacity: 1;
        background-color: rgb(248 250 252 / var(--tw-bg-opacity));
    }

    .bg-slate-300 {
        --tw-bg-opacity: 1;
        background-color: rgb(209 213 219 / var(--tw-bg-opacity));
    }

    .bg-green-100 {
        --tw-bg-opacity: 1;
        background-color: rgb(220 252 231 / var(--tw-bg-opacity));
    }

    .bg-red-100 {
        --tw-bg-opacity: 1;
        background-color: rgb(254 226 226 / var(--tw-bg-opacity));
    }

    .bg-opacity-75 {
        --tw-bg-opacity: 0.75;
    }

    .bg-opacity-50 {
        --tw-bg-opacity: 0.5;
    }

    .fill-current {
        fill: currentColor;
    }

    .stroke-current {
        stroke: currentColor;
    }

    .p-4 {
        padding: 1rem;
    }

    .\!p-0\.5 {
        padding: 0.125rem !important;
    }

    .\!p-0 {
        padding: 0px !important;
    }

    .\!p-1 {
        padding: 0.25rem !important;
    }

    .p-2 {
        padding: 0.5rem;
    }

    .p-1 {
        padding: 0.25rem;
    }

    .py-2 {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    .px-3 {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }

    .px-2\.5 {
        padding-left: 0.625rem;
        padding-right: 0.625rem;
    }

    .py-0\.5 {
        padding-top: 0.125rem;
        padding-bottom: 0.125rem;
    }

    .px-2 {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

    .py-0 {
        padding-top: 0px;
        padding-bottom: 0px;
    }

    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .py-1 {
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
    }

    .py-3 {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }

    .px-1 {
        padding-left: 0.25rem;
        padding-right: 0.25rem;
    }

    .px-8 {
        padding-left: 2rem;
        padding-right: 2rem;
    }

    .py-6 {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }

    .py-3\.5 {
        padding-top: 0.875rem;
        padding-bottom: 0.875rem;
    }

    .py-4 {
        padding-top: 1rem;
        padding-bottom: 1rem;
    }

    .px-6 {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    .py-5 {
        padding-top: 1.25rem;
        padding-bottom: 1.25rem;
    }

    .pl-4 {
        padding-left: 1rem;
    }

    .pr-3 {
        padding-right: 0.75rem;
    }

    .pl-8 {
        padding-left: 2rem;
    }

    .pt-4 {
        padding-top: 1rem;
    }

    .pb-20 {
        padding-bottom: 5rem;
    }

    .pt-5 {
        padding-top: 1.25rem;
    }

    .pb-4 {
        padding-bottom: 1rem;
    }

    .pr-4 {
        padding-right: 1rem;
    }

    .pt-1 {
        padding-top: 0.25rem;
    }

    .pl-3 {
        padding-left: 0.75rem;
    }

    .pr-10 {
        padding-right: 2.5rem;
    }

    .pr-2 {
        padding-right: 0.5rem;
    }

    .pl-10 {
        padding-left: 2.5rem;
    }

    .pr-20 {
        padding-right: 5rem;
    }

    .pr-6 {
        padding-right: 1.5rem;
    }

    .pt-2 {
        padding-top: 0.5rem;
    }

    .pb-3 {
        padding-bottom: 0.75rem;
    }

    .pb-1 {
        padding-bottom: 0.25rem;
    }

    .pt-6 {
        padding-top: 1.5rem;
    }

    .pb-12 {
        padding-bottom: 3rem;
    }

    .pt-3\.5 {
        padding-top: 0.875rem;
    }

    .pt-3 {
        padding-top: 0.75rem;
    }

    .pb-2 {
        padding-bottom: 0.5rem;
    }

    .pt-14 {
        padding-top: 3.5rem;
    }

    .text-left {
        text-align: left;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .align-middle {
        vertical-align: middle;
    }

    .align-bottom {
        vertical-align: bottom;
    }

    .font-sans {
        font-family: Inter var, ui-sans-serif, system-ui, -apple-system,
            BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial,
            "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji",
            "Segoe UI Symbol", "Noto Color Emoji";
    }

    .text-sm {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }

    .text-xs {
        font-size: 0.75rem;
        line-height: 1rem;
    }

    .text-lg {
        font-size: 1.125rem;
        line-height: 1.75rem;
    }

    .text-xl {
        font-size: 1.25rem;
        line-height: 1.75rem;
    }

    .text-base {
        font-size: 1rem;
        line-height: 1.5rem;
    }

    .text-4xl {
        font-size: 2.25rem;
        line-height: 2.5rem;
    }

    .font-semibold {
        font-weight: 600;
    }

    .font-medium {
        font-weight: 500;
    }

    .font-bold {
        font-weight: 700;
    }

    .font-normal {
        font-weight: 400;
    }

    .uppercase {
        text-transform: uppercase;
    }

    .capitalize {
        text-transform: capitalize;
    }

    .italic {
        font-style: italic;
    }

    .leading-5 {
        line-height: 1.25rem;
    }

    .leading-6 {
        line-height: 1.5rem;
    }

    .leading-4 {
        line-height: 1rem;
    }

    .leading-tight {
        line-height: 1.25;
    }

    .tracking-widest {
        letter-spacing: 0.1em;
    }

    .tracking-wide {
        letter-spacing: 0.025em;
    }

    .text-slate-900 {
        --tw-text-opacity: 1;
        color: rgb(17 24 39 / var(--tw-text-opacity));
    }

    .text-slate-500 {
        --tw-text-opacity: 1;
        color: rgb(107 114 128 / var(--tw-text-opacity));
    }

    .text-white {
        --tw-text-opacity: 1;
        color: rgb(255 255 255 / var(--tw-text-opacity));
    }

    .text-indigo-600 {
        --tw-text-opacity: 1;
        color: rgb(79 70 229 / var(--tw-text-opacity));
    }

    .text-slate-700 {
        --tw-text-opacity: 1;
        color: rgb(55 65 81 / var(--tw-text-opacity));
    }

    .text-slate-600 {
        --tw-text-opacity: 1;
        color: rgb(75 85 99 / var(--tw-text-opacity));
    }

    .text-red-500 {
        --tw-text-opacity: 1;
        color: rgb(239 68 68 / var(--tw-text-opacity));
    }

    .text-red-600 {
        --tw-text-opacity: 1;
        color: rgb(220 38 38 / var(--tw-text-opacity));
    }

    .text-slate-400 {
        --tw-text-opacity: 1;
        color: rgb(156 163 175 / var(--tw-text-opacity));
    }

    .text-indigo-700 {
        --tw-text-opacity: 1;
        color: rgb(67 56 202 / var(--tw-text-opacity));
    }

    .text-amber-900 {
        --tw-text-opacity: 1;
        color: rgb(120 53 15 / var(--tw-text-opacity));
    }

    .text-amber-600 {
        --tw-text-opacity: 1;
        color: rgb(217 119 6 / var(--tw-text-opacity));
    }

    .text-purple-600 {
        --tw-text-opacity: 1;
        color: rgb(147 51 234 / var(--tw-text-opacity));
    }

    .text-green-700 {
        --tw-text-opacity: 1;
        color: rgb(21 128 61 / var(--tw-text-opacity));
    }

    .text-slate-800 {
        --tw-text-opacity: 1;
        color: rgb(31 41 55 / var(--tw-text-opacity));
    }

    .text-green-600 {
        --tw-text-opacity: 1;
        color: rgb(22 163 74 / var(--tw-text-opacity));
    }

    .text-orange-500 {
        --tw-text-opacity: 1;
        color: rgb(249 115 22 / var(--tw-text-opacity));
    }

    .text-green-500 {
        --tw-text-opacity: 1;
        color: rgb(34 197 94 / var(--tw-text-opacity));
    }

    .text-indigo-500 {
        --tw-text-opacity: 1;
        color: rgb(99 102 241 / var(--tw-text-opacity));
    }

    .text-green-800 {
        --tw-text-opacity: 1;
        color: rgb(22 101 52 / var(--tw-text-opacity));
    }

    .text-red-800 {
        --tw-text-opacity: 1;
        color: rgb(153 27 27 / var(--tw-text-opacity));
    }

    .text-opacity-90 {
        --tw-text-opacity: 0.9;
    }

    .underline {
        -webkit-text-decoration-line: underline;
        text-decoration-line: underline;
    }

    .antialiased {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .opacity-0 {
        opacity: 0;
    }

    .opacity-100 {
        opacity: 1;
    }

    .opacity-25 {
        opacity: 0.25;
    }

    .shadow-sm {
        --tw-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
            var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
    }

    .shadow-lg {
        --tw-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1),
            0 4px 6px -4px rgb(0 0 0 / 0.1);
        --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color),
            0 4px 6px -4px var(--tw-shadow-color);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
            var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
    }

    .shadow-xl {
        --tw-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1),
            0 8px 10px -6px rgb(0 0 0 / 0.1);
        --tw-shadow-colored: 0 20px 25px -5px var(--tw-shadow-color),
            0 8px 10px -6px var(--tw-shadow-color);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
            var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
    }

    .shadow {
        --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color),
            0 1px 2px -1px var(--tw-shadow-color);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
            var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
    }

    .shadow-md {
        --tw-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1),
            0 2px 4px -2px rgb(0 0 0 / 0.1);
        --tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color),
            0 2px 4px -2px var(--tw-shadow-color);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
            var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
    }

    .outline-none {
        outline: 2px solid transparent;
        outline-offset: 2px;
    }

    .ring-1 {
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow),
            var(--tw-shadow, 0 0 #0000);
    }

    .ring-0 {
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(0px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow),
            var(--tw-shadow, 0 0 #0000);
    }

    .ring-black {
        --tw-ring-opacity: 1;
        --tw-ring-color: rgb(0 0 0 / var(--tw-ring-opacity));
    }

    .ring-opacity-5 {
        --tw-ring-opacity: 0.05;
    }

    .filter {
        filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
    }

    .transition {
        transition-property: color, background-color, border-color, fill, stroke,
            opacity, box-shadow, transform, filter, -webkit-text-decoration-color,
            -webkit-backdrop-filter;
        transition-property: color, background-color, border-color,
            text-decoration-color, fill, stroke, opacity, box-shadow, transform,
            filter, backdrop-filter;
        transition-property: color, background-color, border-color,
            text-decoration-color, fill, stroke, opacity, box-shadow, transform,
            filter, backdrop-filter, -webkit-text-decoration-color,
            -webkit-backdrop-filter;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }

    .transition-opacity {
        transition-property: opacity;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }

    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }

    .transition-colors {
        transition-property: color, background-color, border-color, fill, stroke,
            -webkit-text-decoration-color;
        transition-property: color, background-color, border-color,
            text-decoration-color, fill, stroke;
        transition-property: color, background-color, border-color,
            text-decoration-color, fill, stroke, -webkit-text-decoration-color;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }

    .duration-200 {
        transition-duration: 200ms;
    }

    .duration-75 {
        transition-duration: 75ms;
    }

    .duration-150 {
        transition-duration: 150ms;
    }

    .duration-300 {
        transition-duration: 300ms;
    }

    .duration-500 {
        transition-duration: 500ms;
    }

    .duration-100 {
        transition-duration: 100ms;
    }

    .ease-out {
        transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
    }

    .ease-in {
        transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
    }

    .ease-in-out {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    .dp__input {
        width: 100% !important;
        --tw-border-opacity: 1 !important;
        border-color: rgb(255 255 255 / var(--tw-border-opacity)) !important;
        --tw-bg-opacity: 1 !important;
        background-color: rgb(255 255 255 / var(--tw-bg-opacity)) !important;
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }

    .dp__input:hover {
        --tw-bg-opacity: 1 !important;
        background-color: rgb(249 250 251 / var(--tw-bg-opacity)) !important;
    }

    .hover,
    .hover svg {
        position: relative;
        z-index: 20;
        display: block;
        cursor: pointer;
        outline: 2px solid transparent;
        outline-offset: 2px;
    }

    .hover:after {
        content: "";
        position: absolute;
        top: 0px;
        bottom: 0px;
        z-index: 0;
        margin: auto;
        height: 2rem;
        width: 2rem;
        border-radius: 9999px;
        --tw-bg-opacity: 1;
        background-color: rgb(224 231 255 / var(--tw-bg-opacity));
        opacity: 0;
        left: -11px;
        right: -11px;
        transform: scale(0.3);
        transition: 0.3s ease;
    }

    .hover:hover:after {
        z-index: 0;
        --tw-scale-x: 1;
        --tw-scale-y: 1;
        transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        opacity: 1;
    }

    button:disabled {
        cursor: not-allowed;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        --tw-text-opacity: 1;
        color: rgb(55 65 81 / var(--tw-text-opacity));
    }

    .form-error {
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-style: italic;
        --tw-text-opacity: 1;
        color: rgb(239 68 68 / var(--tw-text-opacity));
    }

    .error {
        --tw-border-opacity: 1;
        border-color: rgb(239 68 68 / var(--tw-border-opacity));
    }

    .hover\:border-slate-300:hover {
        --tw-border-opacity: 1;
        border-color: rgb(209 213 219 / var(--tw-border-opacity));
    }

    .hover\:bg-slate-50:hover {
        --tw-bg-opacity: 1;
        background-color: rgb(249 250 251 / var(--tw-bg-opacity));
    }

    .hover\:bg-indigo-600:hover {
        --tw-bg-opacity: 1;
        background-color: rgb(79 70 229 / var(--tw-bg-opacity));
    }

    .hover\:bg-slate-100:hover {
        --tw-bg-opacity: 1;
        background-color: rgb(243 244 246 / var(--tw-bg-opacity));
    }

    .hover\:bg-red-600:hover {
        --tw-bg-opacity: 1;
        background-color: rgb(220 38 38 / var(--tw-bg-opacity));
    }

    .hover\:bg-green-500:hover {
        --tw-bg-opacity: 1;
        background-color: rgb(34 197 94 / var(--tw-bg-opacity));
    }

    .hover\:bg-slate-500:hover {
        --tw-bg-opacity: 1;
        background-color: rgb(107 114 128 / var(--tw-bg-opacity));
    }

    .hover\:bg-red-500:hover {
        --tw-bg-opacity: 1;
        background-color: rgb(239 68 68 / var(--tw-bg-opacity));
    }

    .hover\:bg-slate-300:hover {
        --tw-bg-opacity: 1;
        background-color: rgb(209 213 219 / var(--tw-bg-opacity));
    }

    .hover\:bg-indigo-700:hover {
        --tw-bg-opacity: 1;
        background-color: rgb(67 56 202 / var(--tw-bg-opacity));
    }

    .hover\:text-slate-500:hover {
        --tw-text-opacity: 1;
        color: rgb(107 114 128 / var(--tw-text-opacity));
    }

    .hover\:text-slate-700:hover {
        --tw-text-opacity: 1;
        color: rgb(55 65 81 / var(--tw-text-opacity));
    }

    .hover\:text-slate-800:hover {
        --tw-text-opacity: 1;
        color: rgb(31 41 55 / var(--tw-text-opacity));
    }

    .hover\:text-orange-500:hover {
        --tw-text-opacity: 1;
        color: rgb(249 115 22 / var(--tw-text-opacity));
    }

    .hover\:text-slate-900:hover {
        --tw-text-opacity: 1;
        color: rgb(17 24 39 / var(--tw-text-opacity));
    }

    .focus\:z-10:focus {
        z-index: 10;
    }

    .focus\:border-indigo-300:focus {
        --tw-border-opacity: 1;
        border-color: rgb(165 180 252 / var(--tw-border-opacity));
    }

    .focus\:border-indigo-500:focus {
        --tw-border-opacity: 1;
        border-color: rgb(99 102 241 / var(--tw-border-opacity));
    }

    .focus\:border-indigo-700:focus {
        --tw-border-opacity: 1;
        border-color: rgb(67 56 202 / var(--tw-border-opacity));
    }

    .focus\:border-slate-300:focus {
        --tw-border-opacity: 1;
        border-color: rgb(209 213 219 / var(--tw-border-opacity));
    }

    .focus\:bg-slate-100:focus {
        --tw-bg-opacity: 1;
        background-color: rgb(243 244 246 / var(--tw-bg-opacity));
    }

    .focus\:bg-indigo-100:focus {
        --tw-bg-opacity: 1;
        background-color: rgb(224 231 255 / var(--tw-bg-opacity));
    }

    .focus\:bg-slate-50:focus {
        --tw-bg-opacity: 1;
        background-color: rgb(249 250 251 / var(--tw-bg-opacity));
    }

    .focus\:text-slate-700:focus {
        --tw-text-opacity: 1;
        color: rgb(55 65 81 / var(--tw-text-opacity));
    }

    .focus\:text-indigo-800:focus {
        --tw-text-opacity: 1;
        color: rgb(55 48 163 / var(--tw-text-opacity));
    }

    .focus\:text-slate-800:focus {
        --tw-text-opacity: 1;
        color: rgb(31 41 55 / var(--tw-text-opacity));
    }

    .focus\:text-slate-500:focus {
        --tw-text-opacity: 1;
        color: rgb(107 114 128 / var(--tw-text-opacity));
    }

    .focus\:outline-none:focus {
        outline: 2px solid transparent;
        outline-offset: 2px;
    }

    .focus\:ring:focus {
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow),
            var(--tw-shadow, 0 0 #0000);
    }

    .focus\:ring-1:focus {
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow),
            var(--tw-shadow, 0 0 #0000);
    }

    .focus\:ring-2:focus {
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow),
            var(--tw-shadow, 0 0 #0000);
    }

    .focus\:ring-indigo-200:focus {
        --tw-ring-opacity: 1;
        --tw-ring-color: rgb(199 210 254 / var(--tw-ring-opacity));
    }

    .focus\:ring-indigo-500:focus {
        --tw-ring-opacity: 1;
        --tw-ring-color: rgb(99 102 241 / var(--tw-ring-opacity));
    }

    .focus\:ring-green-500:focus {
        --tw-ring-opacity: 1;
        --tw-ring-color: rgb(34 197 94 / var(--tw-ring-opacity));
    }

    .focus\:ring-opacity-50:focus {
        --tw-ring-opacity: 0.5;
    }

    .focus\:ring-offset-2:focus {
        --tw-ring-offset-width: 2px;
    }

    .focus-visible\:ring-2:focus-visible {
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow),
            var(--tw-shadow, 0 0 #0000);
    }

    .focus-visible\:ring-white:focus-visible {
        --tw-ring-opacity: 1;
        --tw-ring-color: rgb(255 255 255 / var(--tw-ring-opacity));
    }

    .focus-visible\:ring-opacity-75:focus-visible {
        --tw-ring-opacity: 0.75;
    }

    .focus-visible\:ring-offset-2:focus-visible {
        --tw-ring-offset-width: 2px;
    }

    .focus-visible\:ring-offset-indigo-300:focus-visible {
        --tw-ring-offset-color: #a5b4fc;
    }

    .disabled\:cursor-not-allowed:disabled {
        cursor: not-allowed;
    }

    .disabled\:bg-slate-50:disabled {
        --tw-bg-opacity: 1;
        background-color: rgb(249 250 251 / var(--tw-bg-opacity));
    }

    .group:hover .group-hover\:visible {
        visibility: visible;
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-slate-900 {
            --tw-bg-opacity: 1;
            background-color: rgb(17 24 39 / var(--tw-bg-opacity));
        }

        .dark\:text-slate-100 {
            --tw-text-opacity: 1;
            color: rgb(243 244 246 / var(--tw-text-opacity));
        }

        .dark\:text-white {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity));
        }
    }

    @media (min-width: 640px) {
        .sm\:col-span-4 {
            grid-column: span 4 / span 4;
        }

        .sm\:col-span-3 {
            grid-column: span 3 / span 3;
        }

        .sm\:col-span-2 {
            grid-column: span 2 / span 2;
        }

        .sm\:col-start-1 {
            grid-column-start: 1;
        }

        .sm\:my-8 {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .sm\:-mx-6 {
            margin-left: -1.5rem;
            margin-right: -1.5rem;
        }

        .sm\:-my-px {
            margin-top: -1px;
            margin-bottom: -1px;
        }

        .sm\:mt-6 {
            margin-top: 1.5rem;
        }

        .sm\:ml-10 {
            margin-left: 2.5rem;
        }

        .sm\:ml-6 {
            margin-left: 1.5rem;
        }

        .sm\:block {
            display: block;
        }

        .sm\:inline-block {
            display: inline-block;
        }

        .sm\:flex {
            display: flex;
        }

        .sm\:hidden {
            display: none;
        }

        .sm\:h-screen {
            height: 100vh;
        }

        .sm\:w-full {
            width: 100%;
        }

        .sm\:w-auto {
            width: auto;
        }

        .sm\:max-w-md {
            max-width: 28rem;
        }

        .sm\:translate-y-0 {
            --tw-translate-y: 0px;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }

        .sm\:scale-95 {
            --tw-scale-x: 0.95;
            --tw-scale-y: 0.95;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }

        .sm\:scale-100 {
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }

        .sm\:grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .sm\:items-center {
            align-items: center;
        }

        .sm\:justify-end {
            justify-content: flex-end;
        }

        .sm\:justify-center {
            justify-content: center;
        }

        .sm\:overflow-hidden {
            overflow: hidden;
        }

        .sm\:rounded-lg {
            border-radius: 0.5rem;
        }

        .sm\:rounded-md {
            border-radius: 0.375rem;
        }

        .sm\:rounded-b-lg {
            border-bottom-right-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }

        .sm\:p-0 {
            padding: 0px;
        }

        .sm\:p-6 {
            padding: 1.5rem;
        }

        .sm\:px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .sm\:px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .sm\:px-0 {
            padding-left: 0px;
            padding-right: 0px;
        }

        .sm\:pl-6 {
            padding-left: 1.5rem;
        }

        .sm\:pt-0 {
            padding-top: 0px;
        }

        .sm\:pr-6 {
            padding-right: 1.5rem;
        }

        .sm\:pt-5 {
            padding-top: 1.25rem;
        }

        .sm\:align-middle {
            vertical-align: middle;
        }

        .sm\:text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }
    }

    @media (min-width: 768px) {
        .md\:max-w-xs {
            max-width: 20rem;
        }

        .md\:flex-row {
            flex-direction: row;
        }

        .md\:rounded-lg {
            border-radius: 0.5rem;
        }

        .md\:px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
    }

    @media (min-width: 1024px) {
        .lg\:col-span-3 {
            grid-column: span 3 / span 3;
        }

        .lg\:col-span-9 {
            grid-column: span 9 / span 9;
        }

        .lg\:-mx-8 {
            margin-left: -2rem;
            margin-right: -2rem;
        }

        .lg\:grid {
            display: grid;
        }

        .lg\:max-w-md {
            max-width: 28rem;
        }

        .lg\:grid-cols-12 {
            grid-template-columns: repeat(12, minmax(0, 1fr));
        }

        .lg\:gap-x-5 {
            -moz-column-gap: 1.25rem;
            column-gap: 1.25rem;
        }

        .lg\:px-8 {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .lg\:py-0 {
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .lg\:px-0 {
            padding-left: 0px;
            padding-right: 0px;
        }
    }
</style>
