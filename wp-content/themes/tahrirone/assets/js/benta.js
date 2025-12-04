document.addEventListener('DOMContentLoaded', () => {
    let up = document.getElementById("up");
    let whatsapp = document.getElementById("whatsapp");
    let bars = document.getElementById("bars");
    let mainheader = document.getElementById("mainheader");
    let body = document.body;
    let black, menuItems;
    let wpmenucontianer = document.querySelector(".wp-menu-contianer"); // Should be defined once
    // SVG for the submenu back/arrow button
    const googleSvgLeftArrow = `
    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/>
    </svg>
`;

    // Close SVG for the submenu close button
    const xsvgResponsive = `
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
        <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
    </svg>
`;
    // swipers
    var swiper = new Swiper(".mySwipera", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
    });
    var swiper = new Swiper(".mySwiperb", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
    });
    var swiper = new Swiper(".mySwiperc", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
    });
    var swiper = new Swiper(".shegeftSwiper", {
        slidesPerView: 1,
        spaceBetween: 5,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 15,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
        },
    });
    var swiper = new Swiper(".sellerSwiper", {
        slidesPerView: 1,
        spaceBetween: 5,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 15,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
        },
    });
    var swiper = new Swiper(".brandsSwiper", {
        slidesPerView: 1,
        spaceBetween: 5,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
        },
        breakpoints: {
            640: {
                slidesPerView: 4,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 5,
                spaceBetween: 15,
            },
            1024: {
                slidesPerView: 5.5,
                spaceBetween: 0,
            },
        },
    });
    // hide show up arrow
    if (up) {
        window.addEventListener("scroll", () => {
            if (window.scrollY < 200) {
                up.classList.add("hidden");
                up.classList.remove("block");

            } else {
                up.classList.add("block");
                up.classList.remove("hidden");
            }
            if (window.screen.width < 768) {
                if (window.scrollY > 7530) {
                    up.classList.add("hidden");
                    whatsapp.classList.add("hidden")
                } else {
                    if (window.scrollY < 200) {
                        up.classList.add("hidden");
                        up.classList.remove("block");

                    } else {
                        up.classList.remove("hidden");
                        whatsapp.classList.remove("hidden")
                    }
                }

            }
        })
    }

    // bars
    if (bars) { // It's good practice to check if the element exists
        bars.addEventListener("click", (e) => {
            // Stop the default action (like navigating an <a> tag)
            e.preventDefault();

            // Call the function to open the menu
            showmenu();
        });
    }
    let showmenu = () => {
        // 1. Slide menu into view
        mainheader.classList.add("right-0");
        mainheader.classList.remove("right-100/100");

        // 2. Create and append the backdrop
        black = document.createElement("div");
        black.id = "black";
        black.classList.add("fixed", "top-0", "right-0", "w-full", "h-screen", "z-4", "backdrop-blur-3xl");
        body.append(black);

        // 3. Attach hide event to the backdrop (moved here to correctly access 'black')
        black.addEventListener("click", () => {
            hidemenu();
        });

        // 4. Add submenu arrows and logic
        menuItems = document.querySelectorAll('.menu-item-has-children');

        menuItems.forEach(item => {
            let arrowBox = document.createElement('span');
            arrowBox.classList.add('menu-arrow', 'bg-primary', 'rounded-xl', 'p-4', 'menu-arrow'); // Added custom class 'menu-arrow'
            arrowBox.innerHTML = googleSvgLeftArrow;

            // Append the arrow and add necessary classes to the link/item
            item.append(arrowBox);
            item.classList.add("w-full", "flex", "justify-between");

            let links = item.querySelector("a");
            links.classList.add("block", "w-50/100");

            arrowBox.addEventListener("click", (e) => {
                e.preventDefault(); // Prevent navigating via the link/item click

                let submenu = item.querySelector(".sub-menu");
                if (submenu) {
                    // Logic to display submenu (e.g., sliding it over the main menu)
                    item.classList.add("active");
                    wpmenucontianer.classList.remove("overflow-y-scroll");
                    wpmenucontianer.classList.add("overflow-y-hidden");

                    // Add submenu styles
                    submenu.classList.add("overflow-y-scroll", "p-4!", "pt-13!");

                    // Create and append the close (X) button for the submenu
                    let xBox = document.createElement('span');
                    xBox.classList.add('submenu-close', 'bg-primary', 'rounded-xl', 'p-4', 'text-darkprim', 'w-12', 'h-12', 'block', 'border', 'border-darkprim', 'absolute', 'top-0', 'left-2');
                    xBox.innerHTML = xsvgResponsive;
                    submenu.prepend(xBox); // Use prepend to put it at the top

                    // Submenu close logic
                    xBox.addEventListener("click", () => {
                        // Clean up submenu classes and remove the close button
                        item.classList.remove("active");
                        wpmenucontianer.classList.add("overflow-y-scroll");
                        wpmenucontianer.classList.remove("overflow-y-hidden");
                        submenu.classList.remove("overflow-y-scroll", "p-4!", "pt-13!");
                        xBox.remove();
                    });
                }
            });
        });
    }
    // --- HIDE MENU FUNCTION (FIXED) ---
    let hidemenu = () => {
        // 1. Slide menu off-screen
        mainheader.classList.remove("right-0");
        mainheader.classList.add("right-100/100");

        // 2. Remove backdrop
        if (black) {
            black.remove();
            black = null; // Clear the variable
        }

        // 3. Remove dynamically added arrow spans from all menu items
        // 3. Remove dynamically added arrow spans from all menu items
        if (menuItems) {
            menuItems.forEach(item => {
                // Find ALL elements with the class '.menu-arrow' within the current item.
                const arrowSpans = item.querySelectorAll('.menu-arrow');
                console.log("Found arrowSpans to remove:", arrowSpans.length);

                // Loop through the NodeList and remove each one individually
                arrowSpans.forEach(span => {
                    span.remove();
                    console.log("Removed arrow span:", span);
                });

                // Also ensure the submenu close button is removed if it was added
                const closeSpan = item.querySelector('.submenu-close');
                if (closeSpan) {
                    closeSpan.remove();
                }
                console.log("down item (after cleanup): ", item);
            });
        }
        // 4. Reset overflow on the main container
        wpmenucontianer.classList.remove("relative", "overflow-y-hidden");
        wpmenucontianer.classList.add("overflow-y-scroll");

        // 5. Clean up submenu classes if the variable 'submenu' is accessible or find it again
        // NOTE: 'submenu' is block-scoped in the original code, so we need to iterate or find it if necessary.
        // However, the menu should be cleaned up by the loop above, which removes the close button and resets the state.
        // If you need to explicitly remove submenu classes (like p-4!), you must select the submenu again here.
        menuItems.forEach(item => {
            const submenu = item.querySelector(".sub-menu");
            if (submenu) {
                submenu.classList.remove("overflow-y-scroll", "p-4!", "pt-13!");
            }
        });

        // The line 'arrowBox.remove();' was trying to remove a local variable from showmenu globally and is now fixed by the loop above.
    }
    const headers = document.querySelectorAll('.accordion-header');
    if (headers) {
        headers.forEach(header => {
            header.addEventListener('click', function () {
                // Get the content element immediately following the header
                const content = this.nextElementSibling;
                // Toggle the 'active' class on the header
                this.classList.toggle('active');
                // Check the current state of the content
                if (content.style.maxHeight) {
                    // If max-height is set (i.e., open), close it
                    content.style.maxHeight = null;
                } else {
                    // If it's closed, open it by setting max-height to its scrollHeight
                    // scrollHeight is the minimum height required to fit all content.
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        });
    }
});