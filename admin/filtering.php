<script>
    var categories = [
        "000-099: Generalities, including encyclopedias, computer science, and libraries",
        "100-199: Philosophy and psychology",
        "200-299: Religion",
        "300-399: Social sciences",
        "400-499: Language",
        "500-599: Natural sciences and mathematics",
        "600-699: Technology (applied sciences)",
        "700-799: Arts and recreation",
        "800-899: Literature",
        "900-999: History and geography"
    ];
    
    // Displaying categories without numbers
    categories.forEach(function(category) {
        var categoryName = category.split(': ')[1]; // Split the string and get the category name
        console.log(categoryName);
    });

    document.addEventListener("click", function(event) {
        var categoryOptions = document.getElementById("categoryOptions");
        var bkCatInput = document.getElementById("bk_cat");

        if (event.target !== bkCatInput && event.target.parentNode !== categoryOptions) {
            categoryOptions.style.display = "none";
        }
    });

    function showOptions(input) {
        var options = "";
        for (var i = 0; i < categories.length; i++) {
            if (categories[i].toLowerCase().includes(input.toLowerCase())) {
                options += "<div class='option' onclick='selectOption(\"" + categories[i] + "\")'>" + categories[i] + "</div>";
            }
        }
        var categoryOptions = document.getElementById("categoryOptions");
        if (options) {
            categoryOptions.innerHTML = options;
            categoryOptions.style.display = "block";
        } else {
            categoryOptions.style.display = "none";
        }
    }

    function selectOption(option) {
        document.getElementById("bk_cat").value = option;
        document.getElementById("categoryOptions").style.display = "none";
        populateSubclasses(); 
        populateSubdivisions();
    }

    function populateSubclasses() {
        var mainClass = document.getElementById("bk_cat").value;
        var subClassDropdown = document.getElementById("bk_subcat");
        // var subDivisionDropdown = document.getElementById("bk_subdivision");

        // Clear existing options
        subClassDropdown.innerHTML = '<option value="">Select Sub Class</option>';
        // subDivisionDropdown.innerHTML = '<option value="">Select Subdivision</option>';

        // Extract the subclass range from the main class
        var subclassRange = mainClass.split(":")[0];

        // Define subcategories based on the selected main class
        var subcategories = [];

        // Populate subcategories based on the selected main class
        switch (subclassRange) {
            case "000-099":
                subcategories = [
                    { value: "000: Generalities", label: "000: Generalities" },
                    { value: "010: Bibliography", label: "010: Bibliography" },
                    { value: "020: Library & Information Sciences", label: "020: Library & Information Sciences" },
                    { value: "030: Encyclopedias & books of facts", label: "030: Encyclopedias & books of facts" },
                    { value: "040: [Unassigned]", label: "040: [Unassigned]" },
                    { value: "050: Magazines, journals & serials", label: "050: Magazines, journals & serials" },
                    { value: "060: Associations, organizations & museums", label: "060: Associations, organizations & museums" },
                    { value: "070: News media, journalism & publishing", label: "070: News media, journalism & publishing" },
                    { value: "080: Quotations", label: "080: Quotations" },
                    { value: "090: Manuscripts & rare books", label: "090: Manuscripts & rare books" }
                ];
                break;
            case "100-199":
                subcategories = [
                    { value: "100: Philosophy & psychology", label: "100: Philosophy & psychology" },
                    { value: "110: Metaphysics", label: "110: Metaphysics" },
                    { value: "120: Epistemology", label: "120: Epistemology" },
                    { value: "130: Parapsychology & occultism", label: "130: Parapsychology & occultism" },
                    { value: "140: Philosophical schools of thought", label: "140: Philosophical schools of thought" },
                    { value: "150: Psychology", label: "150: Psychology" },
                    { value: "160: Logic", label: "160: Logic" },
                    { value: "170: Ethics", label: "170: Ethics" },
                    { value: "180: Ancient, medieval, & Eastern philosophy", label: "180: Ancient, medieval, & Eastern philosophy" },
                    { value: "190: Modern Western philosophy", label: "190: Modern Western philosophy" }
                ];
                break;
            case "200-299":
                subcategories = [
                    { value: "200: Religion", label: "200: Religion" },
                    { value: "210: Philosophy & theory of religion", label: "210: Philosophy & theory of religion" },
                    { value: "220: The Bible", label: "220: The Bible" },
                    { value: "230: Christianity & Christian theology", label: "230: Christianity & Christian theology" },
                    { value: "240: Christian practice & observance", label: "240: Christian practice & observance" },
                    { value: "250: Christian pastoral practice & religious orders", label: "250: Christian pastoral practice & religious orders" },
                    { value: "260: Christian organization, social work & worship", label: "260: Christian organization, social work & worship" },
                    { value: "270: History of Christianity", label: "270: History of Christianity" },
                    { value: "280: Christian denominations", label: "280: Christian denominations" },
                    { value: "290: Other religions", label: "290: Other religions" }
                ];
                break;

            case "300-399":
                subcategories = [
                    { value: "300: Social sciences", label: "300: Social sciences" },
                    { value: "310: Statistics", label: "310: Statistics" },
                    { value: "320: Political science", label: "320: Political science" },
                    { value: "330: Economics", label: "330: Economics" },
                    { value: "340: Law", label: "340: Law" },
                    { value: "350: Public administration & military science", label: "350: Public administration & military science" },
                    { value: "360: Social problems & social services", label: "360: Social problems & social services" },
                    { value: "370: Education", label: "370: Education" },
                    { value: "380: Commerce, communications & transportation", label: "380: Commerce, communications & transportation" },
                    { value: "390: Customs, etiquette & folklore", label: "390: Customs, etiquette & folklore" }
                ];
                break;
            case "400-499":
                subcategories = [
                    { value: "400: Language", label: "400: Language" },
                    { value: "410: Linguistics", label: "410: Linguistics" },
                    { value: "420: English & Old English languages", label: "420: English & Old English languages" },
                    { value: "430: Germanic languages; German", label: "430: Germanic languages; German" },
                    { value: "440: French & related Romance languages", label: "440: French & related Romance languages" },
                    { value: "450: Italian, Romanian, & related languages", label: "450: Italian, Romanian, & related languages" },
                    { value: "460: Spanish & Portuguese languages", label: "460: Spanish & Portuguese languages" },
                    { value: "470: Latin & Italic languages", label: "470: Latin & Italic languages" },
                    { value: "480: Hellenic languages; classical Greek", label: "480: Hellenic languages; classical Greek" },
                    { value: "490: Other languages", label: "490: Other languages" }
                ];
                break;
            case "500-599":
                subcategories = [
                    { value: "500: Natural sciences & mathematics", label: "500: Natural sciences & mathematics" },
                    { value: "510: Mathematics", label: "510: Mathematics" },
                    { value: "520: Astronomy", label: "520: Astronomy" },
                    { value: "530: Physics", label: "530: Physics" },
                    { value: "540: Chemistry & allied sciences", label: "540: Chemistry & allied sciences" },
                    { value: "550: Earth sciences & geology", label: "550: Earth sciences & geology" },
                    { value: "560: Fossils & prehistoric life", label: "560: Fossils & prehistoric life" },
                    { value: "570: Biology", label: "570: Biology" },
                    { value: "580: Plants (Botany)", label: "580: Plants (Botany)" },
                    { value: "590: Animals (Zoology)", label: "590: Animals (Zoology)" }
                ];
                break;
            case "600-699":
                subcategories = [
                    { value: "600: Technology (applied sciences)", label: "600: Technology (applied sciences)" },
                    { value: "610: Medicine & health", label: "610: Medicine & health" },
                    { value: "620: Engineering & allied operations", label: "620: Engineering & allied operations" },
                    { value: "630: Agriculture", label: "630: Agriculture" },
                    { value: "640: Home & family management", label: "640: Home & family management" },
                    { value: "650: Management & public relations", label: "650: Management & public relations" },
                    { value: "660: Chemical engineering", label: "660: Chemical engineering" },
                    { value: "670: Manufacturing", label: "670: Manufacturing" },
                    { value: "680: Manufacture for specific uses", label: "680: Manufacture for specific uses" },
                    { value: "690: Construction of buildings", label: "690: Construction of buildings" }
                ];
                break;
            case "700-799":
                subcategories = [
                    { value: "700: Arts and recreation", label: "700: Arts and recreation" },
                    { value: "710: Landscape art & architecture", label: "710: Landscape art & architecture" },
                    { value: "720: Architecture", label: "720: Architecture" },
                    { value: "730: Plastic arts; sculpture", label: "730: Plastic arts; sculpture" },
                    { value: "740: Drawing & decorative arts", label: "740: Drawing & decorative arts" },
                    { value: "750: Painting", label: "750: Painting" },
                    { value: "760: Graphic arts; printmaking & prints", label: "760: Graphic arts; printmaking & prints" },
                    { value: "770: Photography, computer art, film, video", label: "770: Photography, computer art, film, video" },
                    { value: "780: Music", label: "780: Music" },
                    { value: "790: Sports, games & entertainment", label: "790: Sports, games & entertainment" }
                ];
                break;
            case "800-899":
                subcategories = [
                    { value: "800: Literature", label: "800: Literature" },
                    { value: "810: American literature in English", label: "810: American literature in English" },
                    { value: "820: English & Old English literatures", label: "820: English & Old English literatures" },
                    { value: "830: German & related literatures", label: "830: German & related literatures" },
                    { value: "840: French & related literatures", label: "840: French & related literatures" },
                    { value: "850: Italian, Romanian, & related literatures", label: "850: Italian, Romanian, & related literatures" },
                    { value: "860: Spanish & Portuguese literatures", label: "860: Spanish & Portuguese literatures" },
                    { value: "870: Latin & Italic literatures", label: "870: Latin & Italic literatures" },
                    { value: "880: Hellenic literatures; classical Greek", label: "880: Hellenic literatures; classical Greek" },
                    { value: "890: Other literatures", label: "890: Other literatures" }
                ];
                break;
            case "900-999":
                subcategories = [
                    { value: "900: History & geography", label: "900: History & geography" },
                    { value: "910: Geography & travel", label: "910: Geography & travel" },
                    { value: "920: Biography, genealogy, insignia", label: "920: Biography, genealogy, insignia" },
                    { value: "930: History of ancient world to ca. 499", label: "930: History of ancient world to ca. 499" },
                    { value: "940: History of Europe", label: "940: History of Europe" },
                    { value: "950: History of Asia", label: "950: History of Asia" },
                    { value: "960: History of Africa", label: "960: History of Africa" },
                    { value: "970: History of North America", label: "970: History of North America" },
                    { value: "980: History of South America", label: "980: History of South America" },
                    { value: "990: History of other areas", label: "990: History of other areas" }
                ];
                break;
            // Add cases for other subclass ranges
            // Repeat the pattern for other subclass ranges
            default:
                break;
                
        }
        // Populate the subcategory dropdown with options
        subcategories.forEach(function(subcategory) {
            subClassDropdown.innerHTML += '<option value="' + subcategory.value + '">' + subcategory.label + '</option>';
        });
    }

    function populateSubdivisions() {
        var subClass = document.getElementById("bk_subcat").value;
        var subDivisionDropdown = document.getElementById("bk_subdivision");

        // Clear existing options
        subDivisionDropdown.innerHTML = '<option value="">Select Subdivision</option>';

        // Define subdivisions based on the selected subclass
        var subdivisions = [];

        // Populate subdivisions based on the selected subclass
        switch (subClass) {
            case "000: Generalities":
                subdivisions = [
                                        { value: "001: Knowledge", label: "001: Knowledge" },
                                        { value: "002: The book", label: "002: The book" },
                                        { value: "003: Systems", label: "003: Systems" },
                                        { value: "004: Computer science", label: "004: Computer science" },
                                        { value: "005: Computer programming, programs, & data", label: "005: Computer programming, programs, & data" },
                                        { value: "006: Special computer methods", label: "006: Special computer methods" },
                                        { value: "007: [Unassigned]", label: "007: [Unassigned]" },
                                        { value: "008: [Unassigned]", label: "008: [Unassigned]" },
                                        { value: "009: [Unassigned]", label: "009: [Unassigned]" }
                                        // Add other subdivisions for this subcategory
                                    ];
                break;
            case "010: Bibliography":
                subdivisions = [
                    { value: "011: Bibliographies and catalogs", label: "011: Bibliographies and catalogs" },
                    { value: "012: Bibliographies and catalogs of individuals", label: "012: Bibliographies and catalogs of individuals" },
                    { value: "013: [Unassigned]", label: "013: [Unassigned]" },
                    { value: "014: Of anonymous & pseudonymous works", label: "014: Of anonymous & pseudonymous works" },
                    { value: "015: Of works from specific places", label: "015: Of works from specific places" },
                    { value: "016: Of works on specific subjects", label: "016: Of works on specific subjects" },
                    { value: "017: General subject catalogs", label: "017: General subject catalogs" },
                    { value: "018: [Unassigned]", label: "018: [Unassigned]" },
                    { value: "019: [Unassigned]", label: "019: [Unassigned]" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "020: Library & Information Sciences":
                subdivisions = [
                    { value: "021: Relationships of libraries and archives", label: "021: Relationships of libraries and archives" },
                    { value: "022: Administration of physical plant", label: "022: Administration of physical plant" },
                    { value: "023: Personnel management", label: "023: Personnel management" },
                    { value: "024: [Unassigned]", label: "024: [Unassigned]" },
                    { value: "025: Operations of libraries and archives", label: "025: Operations of libraries and archives" },
                    { value: "026: Libraries and archives devoted to specific subjects", label: "026: Libraries and archives devoted to specific subjects" },
                    { value: "027: General libraries and archives", label: "027: General libraries and archives" },
                    { value: "028: Reading and use of other information media", label: "028: Reading and use of other information media" },
                    { value: "029: [Unassigned]", label: "029: [Unassigned]" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "030: Encyclopedias & books of facts":
                subdivisions = [
                    { value: "031: General encyclopedic works in American English", label: "031: General encyclopedic works in American English" },
                    { value: "032: General encyclopedic works in English", label: "032: General encyclopedic works in English" },
                    { value: "033: Encyclopedias in other Germanic languages", label: "033: Encyclopedias in other Germanic languages" },
                    { value: "034: Encyclopedias in French, Occitan & Catalan", label: "034: Encyclopedias in French, Occitan & Catalan" },
                    { value: "035: Encyclopedias in Italian, Romanian & related languages", label: "035: Encyclopedias in Italian, Romanian & related languages" },
                    { value: "036: Encyclopedias in Spanish, Portuguese & Galician", label: "036: Encyclopedias in Spanish, Portuguese & Galician" },
                    { value: "037: General encyclopedic works in Slavic languages", label: "037: General encyclopedic works in Slavic languages" },
                    { value: "038: General encyclopedic works in Scandinavian languages", label: "038: General encyclopedic works in Scandinavian languages" },
                    { value: "039: General encyclopedic works in other languages", label: "039: General encyclopedic works in other languages" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "040: [Unassigned]":
                subdivisions = [
                    { value: "041: [Unassigned]", label: "041: [Unassigned]" },
                    { value: "042: [Unassigned]", label: "042: [Unassigned]" },
                    { value: "043: [Unassigned]", label: "043: [Unassigned]" },
                    { value: "044: [Unassigned]", label: "044: [Unassigned]" },
                    { value: "045: [Unassigned]", label: "045: [Unassigned]" },
                    { value: "046: [Unassigned]", label: "046: [Unassigned]" },
                    { value: "047: [Unassigned]", label: "047: [Unassigned]" },
                    { value: "048: [Unassigned]", label: "048: [Unassigned]" },
                    { value: "049: [Unassigned]", label: "049: [Unassigned]" },// Add other subdivisions for this subcategory
                ];
                break;
            case "050: General serial publications":
                subdivisions = [
                    { value: "051: General serial publications in American English", label: "051: General serial publications in American English" },
                    { value: "052: General serial publications in English", label: "052: General serial publications in English" },
                    { value: "053: Serials in other Germanic languages", label: "053: Serials in other Germanic languages" },
                    { value: "054: Serials in French, Occitan & Catalan", label: "054: Serials in French, Occitan & Catalan" },
                    { value: "055: Serials in Italian, Romanian & related languages", label: "055: Serials in Italian, Romanian & related languages" },
                    { value: "056: Serials in Spanish, Portuguese & Galician", label: "056: Serials in Spanish, Portuguese & Galician" },
                    { value: "057: General serial publications in Slavic languages", label: "057: General serial publications in Slavic languages" },
                    { value: "058: Serials in Scandinavian languages", label: "058: Serials in Scandinavian languages" },
                    { value: "059: General serial publications in other languages", label: "059: General serial publications in other languages" },
                    
                ];
                break;
            case "060: General organizations & museum science":
                subdivisions = [
                    { value: "061: General organizations in North America", label: "061: General organizations in North America" },
                    { value: "062: General organizations in British Isles", label: "062: General organizations in British Isles" },
                    { value: "063: General organizations in Germany; in Central Europe", label: "063: General organizations in Germany; in Central Europe" },
                    { value: "064: General organizations in France and Monaco", label: "064: General organizations in France and Monaco" },
                    { value: "065: General organizations in Italy", label: "065: General organizations in Italy" },
                    { value: "066: General organizations in Spain", label: "066: General organizations in Spain" },
                    { value: "067: General organizations in Russia; in Eastern Europe", label: "067: General organizations in Russia; in Eastern Europe" },
                    { value: "068: General organizations in other geographic areas", label: "068: General organizations in other geographic areas" },
                    { value: "069: Museology (Museum science)", label: "069: Museology (Museum science)" },
                    
                ];
                break;
            case "070: Documentary, educational, news media; journalism":
                subdivisions = [
                    { value: "071: Journalism and newspapers in North America", label: "071: Journalism and newspapers in North America" },
                    { value: "072: Journalism and newspapers in British Isles", label: "072: Journalism and newspapers in British Isles" },
                    { value: "073: Journalism and newspapers in Germany", label: "073: Journalism and newspapers in Germany" },
                    { value: "074: Journalism and newspapers in France and Monaco", label: "074: Journalism and newspapers in France and Monaco" },
                    { value: "075: Journalism and newspapers in Italy", label: "075: Journalism and newspapers in Italy" },
                    { value: "076: Journalism and newspapers in Spain", label: "076: Journalism and newspapers in Spain" },
                    { value: "077: Journalism and newspapers in Russia", label: "077: Journalism and newspapers in Russia" },
                    { value: "078: Journalism and newspapers in Scandinavia", label: "078: Journalism and newspapers in Scandinavia" },
                    { value: "079: Newspapers in other geographic areas", label: "079: Newspapers in other geographic areas" },
                    
                ];
                break;
            case "080: Quotations":
                subdivisions = [
                    { value: "081: General collections in American English", label: "081: General collections in American English" },
                    { value: "082: General collections in English", label: "082: General collections in English" },
                    { value: "083: General collections in other Germanic languages", label: "083: General collections in other Germanic languages" },
                    { value: "084: General collections in French, Occitan & Catalan", label: "084: General collections in French, Occitan & Catalan" },
                    { value: "085: Collections in Italian, Romanian & related languages", label: "085: Collections in Italian, Romanian & related languages" },
                    { value: "086: Collections in Spanish, Portuguese & Galician", label: "086: Collections in Spanish, Portuguese & Galician" },
                    { value: "087: General collections in Slavic languages", label: "087: General collections in Slavic languages" },
                    { value: "088: General collections in Scandinavian languages", label: "088: General collections in Scandinavian languages" },
                    { value: "089: General collections in other languages", label: "089: General collections in other languages" },
                    
                ];
                break;
            case "090: Manuscripts & rare books":
                subdivisions = [
                    { value: "091: Manuscripts", label: "091: Manuscripts" },
                    { value: "092: Block books", label: "092: Block books" },
                    { value: "093: Incunabula", label: "093: Incunabula" },
                    { value: "094: Printed books", label: "094: Printed books" },
                    { value: "095: Books notable for bindings", label: "095: Books notable for bindings" },
                    { value: "096: Books notable for illustrations and materials", label: "096: Books notable for illustrations and materials" },
                    { value: "097: Books notable for ownership or origin", label: "097: Books notable for ownership or origin" },
                    { value: "098: Prohibited works, forgeries, hoaxes", label: "098: Prohibited works, forgeries, hoaxes" },
                    { value: "099: Books notable for format", label: "099: Books notable for format" }
                ];
                break;

                case "100: Philosophy & psychology":
                subdivisions = [
                    { value: "101: Theory of philosophy", label: "101: Theory of philosophy" },
                    { value: "102: Miscellany of philosophy", label: "102: Miscellany of philosophy" },
                    { value: "103: Dictionaries & encyclopedias", label: "103: Dictionaries & encyclopedias" },
                    { value: "104: [Unassigned]", label: "104: [Unassigned]" },
                    { value: "105: Serial publications of philosophy", label: "105: Serial publications of philosophy" },
                    { value: "106: Organizations & management", label: "106: Organizations & management" },
                    { value: "107: Education, research & related topics", label: "107: Education, research & related topics" },
                    { value: "108: Groups of people", label: "108: Groups of people" },
                    { value: "109: History and collected biography", label: "109: History and collected biography" },
                    
                ];
                break;
            case "110: Metaphysics":
                subdivisions = [
                    { value: "111: Ontology", label: "111: Ontology" },
                    { value: "112: [Unassigned]", label: "112: [Unassigned]" },
                    { value: "113: Cosmology (Philosophy of nature)", label: "113: Cosmology (Philosophy of nature)" },
                    { value: "114: Space", label: "114: Space" },
                    { value: "115: Time", label: "115: Time" },
                    { value: "116: Change", label: "116: Change" },
                    { value: "117: Structure", label: "117: Structure" },
                    { value: "118: Force and energy", label: "118: Force and energy" },
                    { value: "119: Number and quantity", label: "119: Number and quantity" },
                    
                ];
                break;
            case "120: Epistemology":
                subdivisions = [
                    { value: "121: Epistemology (Theory of knowledge)", label: "121: Epistemology (Theory of knowledge)" },
                    { value: "122: Causation", label: "122: Causation" },
                    { value: "123: Determinism and indeterminism", label: "123: Determinism and indeterminism" },
                    { value: "124: Teleology", label: "124: Teleology" },
                    { value: "125: [Unassigned]", label: "125: [Unassigned]" },
                    { value: "126: The self", label: "126: The self" },
                    { value: "127: The unconscious and the subconscious", label: "127: The unconscious and the subconscious" },
                    { value: "128: Humankind", label: "128: Humankind" },
                    { value: "129: Origin and destiny of individual souls", label: "129: Origin and destiny of individual souls" },
                            
                ];
                break;
            case "130: Parapsychology & occultism":
                subdivisions = [
                    { value: "121: Epistemology (Theory of knowledge)", label: "121: Epistemology (Theory of knowledge)" },
                    { value: "122: Causation", label: "122: Causation" },
                    { value: "123: Determinism and indeterminism", label: "123: Determinism and indeterminism" },
                    { value: "124: Teleology", label: "124: Teleology" },
                    { value: "125: [Unassigned]", label: "125: [Unassigned]" },
                    { value: "126: The self", label: "126: The self" },
                    { value: "127: The unconscious and the subconscious", label: "127: The unconscious and the subconscious" },
                    { value: "128: Humankind", label: "128: Humankind" },
                    { value: "129: Origin and destiny of individual souls", label: "129: Origin and destiny of individual souls" },

                ];  
                break;     
            case "140: Philosophical schools of thought":
                subdivisions = [
                    { value: "141: Idealism and related systems", label: "141: Idealism and related systems" },
                    { value: "142: Critical philosophy", label: "142: Critical philosophy" },
                    { value: "143: Bergsonism and intuitionism", label: "143: Bergsonism and intuitionism" },
                    { value: "144: Humanism and related systems", label: "144: Humanism and related systems" },
                    { value: "145: Sensationalism", label: "145: Sensationalism" },
                    { value: "146: Naturalism and related systems", label: "146: Naturalism and related systems" },
                    { value: "147: Pantheism and related systems", label: "147: Pantheism and related systems" },
                    { value: "148: Eclecticism, liberalism, & traditionalism", label: "148: Eclecticism, liberalism, & traditionalism" },
                    { value: "149: Other philosophical systems and doctrines", label: "149: Other philosophical systems and doctrines" }
                
                ];  
                break;
            case "150: Psychology":
                subdivisions = [
                    { value: "151: [Unassigned]", label: "151: [Unassigned]" },
                    { value: "152: Perception, movement, emotions & drives", label: "152: Perception, movement, emotions & drives" },
                    { value: "153: Conscious mental processes & intelligence", label: "153: Conscious mental processes & intelligence" },
                    { value: "154: Subconscious & altered states", label: "154: Subconscious & altered states" },
                    { value: "155: Differential & developmental psychology", label: "155: Differential & developmental psychology" },
                    { value: "156: Comparative psychology", label: "156: Comparative psychology" },
                    { value: "157: [Unassigned]", label: "157: [Unassigned]" },
                    { value: "158: Applied psychology", label: "158: Applied psychology" },
                    { value: "159: [Unassigned]", label: "159: [Unassigned]" },
            
                ];  
                break;
            case "160: Logic": 
                subdivisions = [
                    { value: "161: Induction", label: "161: Induction" },
                    { value: "162: Deduction", label: "162: Deduction" },
                    { value: "163: [Unassigned]", label: "163: [Unassigned]" },
                    { value: "164: [Unassigned]", label: "164: [Unassigned]" },
                    { value: "165: Fallacies and sources of error", label: "165: Fallacies and sources of error" },
                    { value: "166: Syllogisms", label: "166: Syllogisms" },
                    { value: "167: Hypotheses", label: "167: Hypotheses" },
                    { value: "168: Argument and persuasion", label: "168: Argument and persuasion" },
                    { value: "169: Analogy", label: "169: Analogy" },
            
                ];  
                break;
            case "170: Ethics": 
                subdivisions = [
                    { value: "171: Ethical systems", label: "171: Ethical systems" },
                    { value: "172: Political ethics", label: "172: Political ethics" },
                    { value: "173: Ethics of family relationships", label: "173: Ethics of family relationships" },
                    { value: "174: Occupational ethics", label: "174: Occupational ethics" },
                    { value: "175: Ethics of recreation & leisure", label: "175: Ethics of recreation & leisure" },
                    { value: "176: Ethics of sex & reproduction", label: "176: Ethics of sex & reproduction" },
                    { value: "177: Ethics of social relations", label: "177: Ethics of social relations" },
                    { value: "178: Ethics of consumption", label: "178: Ethics of consumption" },
                    { value: "179: Other ethical norms", label: "179: Other ethical norms" },
            
                ];  
                break;
            case "180: Ancient, medieval, & Eastern philosophy": 
                subdivisions = [
                    { value: "181: Eastern philosophy", label: "181: Eastern philosophy" },
                    { value: "182: Pre-Socratic Greek philosophies", label: "182: Pre-Socratic Greek philosophies" },
                    { value: "183: Sophistic, Socratic, related philosophies", label: "183: Sophistic, Socratic, related philosophies" },
                    { value: "184: Platonic philosophy", label: "184: Platonic philosophy" },
                    { value: "185: Aristotelian philosophy", label: "185: Aristotelian philosophy" },
                    { value: "186: Skeptic and Neoplatonic philosophies", label: "186: Skeptic and Neoplatonic philosophies" },
                    { value: "187: Epicurean philosophy", label: "187: Epicurean philosophy" },
                    { value: "188: Stoic philosophy", label: "188: Stoic philosophy" },
                    { value: "189: Medieval western philosophy", label: "189: Medieval western philosophy" },
            
                ];  
                break;
            case "190: Modern Western philosophy": 
                subdivisions = [
                    { value: "191: Philosophy of United States and Canada", label: "191: Philosophy of United States and Canada" },
                    { value: "192: Philosophy of British Isles", label: "192: Philosophy of British Isles" },
                    { value: "193: Philosophy of Germany and Austria", label: "193: Philosophy of Germany and Austria" },
                    { value: "194: Philosophy of France", label: "194: Philosophy of France" },
                    { value: "195: Philosophy of Italy", label: "195: Philosophy of Italy" },
                    { value: "196: Philosophy of Spain and Portugal", label: "196: Philosophy of Spain and Portugal" },
                    { value: "197: Philosophy of Russia", label: "197: Philosophy of Russia" },
                    { value: "198: Philosophy of Scandinavia and Finland", label: "198: Philosophy of Scandinavia and Finland" },
                    { value: "199: Philosophy of other geographic areas", label: "199: Philosophy of other geographic areas" }
            
                ];  
                break;
            case "200: Religion": 
                subdivisions = [
                    { value: "201: Religious mythology & social theology", label: "201: Religious mythology & social theology" },
                    { value: "202: Doctrines", label: "202: Doctrines" },
                    { value: "203: Public worship and other practices", label: "203: Public worship and other practices" },
                    { value: "204: Religious experience, life, practice", label: "204: Religious experience, life, practice" },
                    { value: "205: Religious ethics", label: "205: Religious ethics" },
                    { value: "206: Leaders and organization", label: "206: Leaders and organization" },
                    { value: "207: Missions and religious education", label: "207: Missions and religious education" },
                    { value: "208: Sources", label: "208: Sources" },
                    { value: "209: Sects and reform movements", label: "209: Sects and reform movements" }
            
                ];  
                break;
            case "210: Philosophy & theory of religion": 
                subdivisions = [
                    { value: "211: Concepts of God", label: "211: Concepts of God" },
                    { value: "212: Existence, knowability & attributes of God", label: "212: Existence, knowability & attributes of God" },
                    { value: "213: Creation", label: "213: Creation" },
                    { value: "214: Theodicy", label: "214: Theodicy" },
                    { value: "215: Science and religion", label: "215: Science and religion" },
                    { value: "216: [Unassigned]", label: "216: [Unassigned]" },
                    { value: "217: [Unassigned]", label: "217: [Unassigned]" },
                    { value: "218: Humankind", label: "218: Humankind" },
                    { value: "219: [Unassigned]", label: "219: [Unassigned]" }
            
                ];  
                break;
            case "220: The Bible": 
                subdivisions = [
                    { value: "221: Old Testament (Tanakh)", label: "221: Old Testament (Tanakh)" },
                    { value: "222: Historical books of Old Testament", label: "222: Historical books of Old Testament" },
                    { value: "223: Poetic books of Old Testament", label: "223: Poetic books of Old Testament" },
                    { value: "224: Prophetic books of Old Testament", label: "224: Prophetic books of Old Testament" },
                    { value: "225: New Testament", label: "225: New Testament" },
                    { value: "226: Gospels and Acts", label: "226: Gospels and Acts" },
                    { value: "227: Epistles", label: "227: Epistles" },
                    { value: "228: Revelation (Apocalypse)", label: "228: Revelation (Apocalypse)" },
                    { value: "229: Apocrypha and pseudepigrapha", label: "229: Apocrypha and pseudepigrapha" },
             
                ];  
                break;
            case "230: Christianity & Christian theology": 
                subdivisions = [
                    { value: "231: God", label: "231: God" },
                    { value: "232: Jesus Christ and his family", label: "232: Jesus Christ and his family" },
                    { value: "233: Humankind", label: "233: Humankind" },
                    { value: "234: Salvation and grace", label: "234: Salvation and grace" },
                    { value: "235: Spiritual beings", label: "235: Spiritual beings" },
                    { value: "236: Eschatology", label: "236: Eschatology" },
                    { value: "237: [Unassigned]", label: "237: [Unassigned]" },
                    { value: "238: Creeds & catechisms", label: "238: Creeds & catechisms" },
                    { value: "239: Apologetics and polemics", label: "239: Apologetics and polemics" }
                    
                ];  
                break;
            case "240: Christian practice & observance": 
                subdivisions = [
                    { value: "241: Christian ethics", label: "241: Christian ethics" },
                    { value: "242: Devotional literature", label: "242: Devotional literature" },
                    { value: "243: Evangelistic writings for individuals", label: "243: Evangelistic writings for individuals" },
                    { value: "244: [Unassigned]", label: "244: [Unassigned]" },
                    { value: "245: [Unassigned]", label: "245: [Unassigned]" },
                    { value: "246: Use of art in Christianity", label: "246: Use of art in Christianity" },
                    { value: "247: Church furnishings and related articles", label: "247: Church furnishings and related articles" },
                    { value: "248: Christian experience, practice, life", label: "248: Christian experience, practice, life" },
                    { value: "249: Christian observances in family life", label: "249: Christian observances in family life" }
                    
                ];  
                break;
            case "250 Local Christian church and religious orders": 
                subdivisions = [
                    { value: "251: Preaching (Homiletics)", label: "251: Preaching (Homiletics)" },
                    { value: "252: Texts of sermons", label: "252: Texts of sermons" },
                    { value: "253: Pastoral work (Pastoral theology)", label: "253: Pastoral work (Pastoral theology)" },
                    { value: "254: Local church administration", label: "254: Local church administration" },
                    { value: "255: Religious congregations and orders", label: "255: Religious congregations and orders" },
                    { value: "256: [Unassigned]", label: "256: [Unassigned]" },
                    { value: "257: [Unassigned]", label: "257: [Unassigned]" },
                    { value: "258: [Unassigned]", label: "258: [Unassigned]" },
                    { value: "259: Pastoral care of families & groups of people", label: "259: Pastoral care of families & groups of people" },

                ];
                break;
            case "260: Christian organization, social work & worship": 
                subdivisions = [
                    { value: "261: Social theology and interreligious relations", label: "261: Social theology and interreligious relations" },
                    { value: "262: Ecclesiology", label: "262: Ecclesiology" },
                    { value: "263: Days, times, places of religious observance", label: "263: Days, times, places of religious observance" },
                    { value: "264: Public worship", label: "264: Public worship" },
                    { value: "265: Sacraments, other rites and acts", label: "265: Sacraments, other rites and acts" },
                    { value: "266: Missions", label: "266: Missions" },
                    { value: "267: Associations for religious work", label: "267: Associations for religious work" },
                    { value: "268: Religious education", label: "268: Religious education" },
                    { value: "269: Spiritual renewal", label: "269: Spiritual renewal" },
                    
                ];
                break;
            case "270: History of Christianity": 
                subdivisions = [
                    { value: "271: Religious orders in church history", label: "271: Religious orders in church history" },
                    { value: "272: Persecutions in general church history", label: "272: Persecutions in general church history" },
                    { value: "273: Doctrinal controversies & heresies", label: "273: Doctrinal controversies & heresies" },
                    { value: "274: History of Christianity in Europe", label: "274: History of Christianity in Europe" },
                    { value: "275: History of Christianity in Asia", label: "275: History of Christianity in Asia" },
                    { value: "276: History of Christianity in Africa", label: "276: History of Christianity in Africa" },
                    { value: "277: History of Christianity in North America", label: "277: History of Christianity in North America" },
                    { value: "278: History of Christianity in South America", label: "278: History of Christianity in South America" },
                    { value: "279: History of Christianity in other areas", label: "279: History of Christianity in other areas" },
                    
                ];
                break;
            case "280: Christian denominations": 
                subdivisions = [
                    { value: "281: Early church and Eastern churches", label: "281: Early church and Eastern churches" },
                    { value: "282: Roman Catholic Church", label: "282: Roman Catholic Church" },
                    { value: "283: Anglican churches", label: "283: Anglican churches" },
                    { value: "284: Protestants of Continental origin", label: "284: Protestants of Continental origin" },
                    { value: "285: Presbyterian, Reformed & Congregational", label: "285: Presbyterian, Reformed & Congregational" },
                    { value: "286: Baptist, Restoration & Adventist", label: "286: Baptist, Restoration & Adventist" },
                    { value: "287: Methodist and related churches", label: "287: Methodist and related churches" },
                    { value: "288: [Unassigned]", label: "288: [Unassigned]" },
                    { value: "289: Other denominations and sects", label: "289: Other denominations and sects" },
                    
                ];
                break;
            case "290: Other religions": 
                subdivisions = [
                    { value: "291: [Unassigned]", label: "291: [Unassigned]" },
                    { value: "292: Classical religion (Greek & Roman religion)", label: "292: Classical religion (Greek & Roman religion)" },
                    { value: "293: Germanic religion", label: "293: Germanic religion" },
                    { value: "294: Religions of Indic origin", label: "294: Religions of Indic origin" },
                    { value: "295: Zoroastrianism (Mazdaism, Parseeism)", label: "295: Zoroastrianism (Mazdaism, Parseeism)" },
                    { value: "296: Judaism", label: "296: Judaism" },
                    { value: "297: Islam, Babism & Bahai Faith", label: "297: Islam, Babism & Bahai Faith" },
                    { value: "298: [Optional number]", label: "298: [Optional number]" },
                    { value: "299: Religions not provided for elsewhere", label: "299: Religions not provided for elsewhere" },
                    
                ];
                break;

            case "300: Social sciences":
                subdivisions = [
                    { value: "301: Sociology and anthropology", label: "301: Sociology and anthropology" },
                    { value: "302: Social interaction", label: "302: Social interaction" },
                    { value: "303: Social processes", label: "303: Social processes" },
                    { value: "304: Factors affecting social behavior", label: "304: Factors affecting social behavior" },
                    { value: "305: Groups of people", label: "305: Groups of people" },
                    { value: "306: Culture and institutions", label: "306: Culture and institutions" },
                    { value: "307: Communities", label: "307: Communities" },
                    { value: "308: [Unassigned] ", label: "308: [Unassigned] " },
                    { value: "309: [Unassigned] ", label: "309: [Unassigned] " }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "310: Statistics":
                subdivisions = [
                    { value: "311: [Unassigned]", label: "311: [Unassigned]" },
                    { value: "312: [Unassigned]", label: "312: [Unassigned]" },
                    { value: "313: [Unassigned]", label: "313: [Unassigned]" },
                    { value: "314: General statistics of Europe", label: "314: General statistics of Europe" },
                    { value: "315: General statistics of Asia", label: "315: General statistics of Asia" },
                    { value: "316: General statistics of Africa", label: "316: General statistics of Africa" },
                    { value: "317: General statistics of North America", label: "317: General statistics of North America" },
                    { value: "318: General statistics of South America", label: "318: General statistics of South America" },
                    { value: "319: General statistics of other areas", label: "319: General statistics of other areas" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "320: Political science":
                subdivisions = [
                    { value: "321: Systems of governments and states", label: "321: Systems of governments and states" },
                    { value: "322: Relation of state to organized groups", label: "322: Relation of state to organized groups" },
                    { value: "323: Civil and political rights", label: "323: Civil and political rights" },
                    { value: "324: The political process", label: "324: The political process" },
                    { value: "325: International migration and colonization", label: "325: International migration and colonization" },
                    { value: "326: Slavery and emancipation", label: "326: Slavery and emancipation" },
                    { value: "327: International relations", label: "327: International relations" },
                    { value: "328: The legislative process", label: "328: The legislative process" },
                    { value: "329: [Unassigned]", label: "329: [Unassigned]" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "330: Economics":
                subdivisions = [
                    { value: "331: Labor economics", label: "331: Labor economics" },
                    { value: "332: Financial economics", label: "332: Financial economics" },
                    { value: "333: Economics of land and energy", label: "333: Economics of land and energy" },
                    { value: "334: Cooperatives", label: "334: Cooperatives" },
                    { value: "335: Socialism and related systems", label: "335: Socialism and related systems" },
                    { value: "336: Public finance", label: "336: Public finance" },
                    { value: "337: International economics", label: "337: International economics" },
                    { value: "338: Production", label: "338: Production" },
                    { value: "339: Macroeconomics and related topics", label: "339: Macroeconomics and related topics" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "340: Law":
                subdivisions = [
                    { value: "341: Law of nations", label: "341: Law of nations" },
                    { value: "342: Constitutional and administrative law", label: "342: Constitutional and administrative law" },
                    { value: "343: Military, tax, trade & industrial law", label: "343: Military, tax, trade & industrial law" },
                    { value: "344: Labor, social, education & cultural law", label: "344: Labor, social, education & cultural law" },
                    { value: "345: Criminal law", label: "345: Criminal law" },
                    { value: "346: Private law", label: "346: Private law" },
                    { value: "347: Procedure and courts", label: "347: Procedure and courts" },
                    { value: "348: Laws, regulations, cases", label: "348: Laws, regulations, cases" },
                    { value: "349: Law of specific jurisdictions & areas", label: "349: Law of specific jurisdictions & areas" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "350: Public administration and military science":
                subdivisions = [
                    { value: "351: Public administration", label: "351: Public administration" },
                    { value: "352: General considerations of public administration", label: "352: General considerations of public administration" },
                    { value: "353: Specific fields of public administration", label: "353: Specific fields of public administration" },
                    { value: "354: Administration of economy & environment", label: "354: Administration of economy & environment" },
                    { value: "355: Military science", label: "355: Military science" },
                    { value: "356: Foot forces & warfare", label: "356: Foot forces & warfare" },
                    { value: "357: Mounted forces & warfare", label: "357: Mounted forces & warfare" },
                    { value: "358: Air & other specialized forces", label: "358: Air & other specialized forces" },
                    { value: "359: Naval forces and warfare", label: "359: Naval forces and warfare" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "360: Social problems & social services":
                subdivisions = [
                    { value: "361: Social problems and services", label: "361: Social problems and services" },
                    { value: "362: Social problems and services to groups", label: "362: Social problems and services to groups" },
                    { value: "363: Other social problems and services", label: "363: Other social problems and services" },
                    { value: "364: Criminology", label: "364: Criminology" },
                    { value: "365: Penal and related institutions", label: "365: Penal and related institutions" },
                    { value: "366: Secret associations and societies", label: "366: Secret associations and societies" },
                    { value: "367: General clubs", label: "367: General clubs" },
                    { value: "368: Insurance", label: "368: Insurance" },
                    { value: "369: Associations", label: "369: Associations" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "370: Education":
                subdivisions = [
                    { value: "371: Schools and their activities; special education", label: "371: Schools and their activities; special education" },
                    { value: "372: Primary education (Elementary education)", label: "372: Primary education (Elementary education)" },
                    { value: "373: Secondary education", label: "373: Secondary education" },
                    { value: "374: Adult education", label: "374: Adult education" },
                    { value: "375: Curricula", label: "375: Curricula" },
                    { value: "376: [Unassigned]", label: "376: [Unassigned]" },
                    { value: "377: [Unassigned]", label: "377: [Unassigned]" },
                    { value: "378: Higher education (Tertiary education)", label: "378: Higher education (Tertiary education)" },
                    { value: "379: Public policy issues in education", label: "379: Public policy issues in education" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "380: Commerce, communications & transportation":
                subdivisions = [
                    { value: "081: Commerce (Trade)", label: "081: Commerce (Trade)" },
                    { value: "082: International commerce (Foreign trade)", label: "082: International commerce (Foreign trade)" },
                    { value: "083: Postal communication", label: "083: Postal communication" },
                    { value: "084: Communications", label: "084: Communications" },
                    { value: "085: Railroad transportation", label: "085: Railroad transportation" },
                    { value: "086: Inland waterway and ferry transportation", label: "086: Inland waterway and ferry transportation" },
                    { value: "087: Water, air, space transportation", label: "087: Water, air, space transportation" },
                    { value: "088: Transportation", label: "088: Transportation" },
                    { value: "089: Metrology and standardization", label: "089: Metrology and standardization" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "390: Customs, etiquette & folklore":
                subdivisions = [
                    { value: "091: Costume and personal appearance", label: "091: Costume and personal appearance" },
                    { value: "092: Customs of life cycle and domestic life", label: "092: Customs of life cycle and domestic life" },
                    { value: "093: Death customs", label: "093: Death customs" },
                    { value: "094: General customs", label: "094: General customs" },
                    { value: "095: Etiquette (Manners)", label: "095: Etiquette (Manners)" },
                    { value: "096: [Unassigned]", label: "096: [Unassigned]" },
                    { value: "097: [Unassigned]", label: "097: [Unassigned]" },
                    { value: "098: Folklore", label: "098: Folklore" },
                    { value: "099: Customs of war and diplomacy", label: "099: Customs of war and diplomacy" }
                    // Add other subdivisions for this subcategory
                ];
                break;



                
            case "800: Literature": 
                subdivisions = [
                    { value: "801: Philosophy and theory", label: "801: Philosophy and theory" },
                    { value: "802: Miscellany", label: "802: Miscellany" },
                    { value: "803: Dictionaries & encyclopedias", label: "803: Dictionaries & encyclopedias" },
                    { value: "804: [Unassigned]", label: "804: [Unassigned]" },
                    { value: "805: Serial publications", label: "805: Serial publications" },
                    { value: "806: Organizations and management", label: "806: Organizations and management" },
                    { value: "807: Education, research, related topics", label: "807: Education, research, related topics" },
                    { value: "808: Rhetoric & collections of literature", label: "808: Rhetoric & collections of literature" },
                    { value: "809: History, description & criticism", label: "809: History, description & criticism" },
                    
                ];
                break;
            case "810: American literature in English": 
                subdivisions = [
                    { value: "811: American poetry in English", label: "811: American poetry in English" },
                    { value: "812: American drama in English", label: "812: American drama in English" },
                    { value: "813: American fiction in English", label: "813: American fiction in English" },
                    { value: "814: American essays in English", label: "814: American essays in English" },
                    { value: "815: American speeches in English", label: "815: American speeches in English" },
                    { value: "816: American letters in English", label: "816: American letters in English" },
                    { value: "817: American humor and satire in English", label: "817: American humor and satire in English" },
                    { value: "818: American miscellaneous writings", label: "818: American miscellaneous writings" },
                    { value: "819: [Optional number]", label: "819: [Optional number]" },
                    
                ];
                break;
            case "820: English & Old English literatures": 
                subdivisions = [
                    { value: "821: English poetry", label: "821: English poetry" },
                    { value: "822: English drama", label: "822: English drama" },
                    { value: "823: English fiction", label: "823: English fiction" },
                    { value: "824: English essays", label: "824: English essays" },
                    { value: "825: English speeches", label: "825: English speeches" },
                    { value: "826: English letters", label: "826: English letters" },
                    { value: "827: English humor and satire", label: "827: English humor and satire" },
                    { value: "828: English miscellaneous writings", label: "828: English miscellaneous writings" },
                    { value: "829: Old English (Anglo-Saxon) literature", label: "829: Old English (Anglo-Saxon) literature" },
                    
                ];
                break;
            case "830: German & related literatures": 
                subdivisions = [
                    { value: "831: German poetry", label: "831: German poetry" },
                    { value: "832: German drama", label: "832: German drama" },
                    { value: "833: German fiction", label: "833: German fiction" },
                    { value: "834: German essays", label: "834: German essays" },
                    { value: "835: German speeches", label: "835: German speeches" },
                    { value: "836: German letters", label: "836: German letters" },
                    { value: "837: German humor and satire", label: "837: German humor and satire" },
                    { value: "838: German miscellaneous writings", label: "838: German miscellaneous writings" },
                    { value: "839: Other Germanic literatures", label: "839: Other Germanic literatures" },
                    
                ];
                break;
            case "840: French & related literatures": 
                subdivisions = [
                    { value: "841: French poetry", label: "841: French poetry" },
                    { value: "842: French drama", label: "842: French drama" },
                    { value: "843: French fiction", label: "843: French fiction" },
                    { value: "844: French essays", label: "844: French essays" },
                    { value: "845: French speeches", label: "845: French speeches" },
                    { value: "846: French letters", label: "846: French letters" },
                    { value: "847: French humor and satire", label: "847: French humor and satire" },
                    { value: "848: French miscellaneous writings", label: "848: French miscellaneous writings" },
                    { value: "849: Occitan & Catalan literatures", label: "849: Occitan & Catalan literatures" },
                    
                ];
                break;
            case "850: Italian, Romanian, & related literatures": 
                subdivisions = [
                    { value: "851: Italian poetry", label: "851: Italian poetry" },
                    { value: "852: Italian drama", label: "852: Italian drama" },
                    { value: "853: Italian fiction", label: "853: Italian fiction" },
                    { value: "854: Italian essays", label: "854: Italian essays" },
                    { value: "855: Italian speeches", label: "855: Italian speeches" },
                    { value: "856: Italian letters", label: "856: Italian letters" },
                    { value: "857: Italian humor and satire", label: "857: Italian humor and satire" },
                    { value: "858: Italian miscellaneous writings", label: "858: Italian miscellaneous writings" },
                    { value: "859: Romanian & related literatures", label: "859: Romanian & related literatures" },
           
                    
                ];
                break;
            case "860: Spanish & Portuguese literatures": 
                subdivisions = [
                    { value: "861: Spanish poetry", label: "861: Spanish poetry" },
                    { value: "862: Spanish drama", label: "862: Spanish drama" },
                    { value: "863: Spanish fiction", label: "863: Spanish fiction" },
                    { value: "864: Spanish essays", label: "864: Spanish essays" },
                    { value: "865: Spanish speeches", label: "865: Spanish speeches" },
                    { value: "866: Spanish letters", label: "866: Spanish letters" },
                    { value: "867: Spanish humor and satire", label: "867: Spanish humor and satire" },
                    { value: "868: Spanish miscellaneous writings", label: "868: Spanish miscellaneous writings" },
                    { value: "869: Portuguese and Galician literatures", label: "869: Portuguese and Galician literatures" },
           
                    
                ];
                break;
            case "870: Latin & Italic literatures": 
                subdivisions = [
                    { value: "871: Latin poetry", label: "871: Latin poetry" },
                    { value: "872: Latin dramatic poetry and drama", label: "872: Latin dramatic poetry and drama" },
                    { value: "873: Latin epic poetry and fiction", label: "873: Latin epic poetry and fiction" },
                    { value: "874: Latin lyric poetry", label: "874: Latin lyric poetry" },
                    { value: "875: Latin speeches", label: "875: Latin speeches" },
                    { value: "876: Latin letters", label: "876: Latin letters" },
                    { value: "877: Latin humor and satire", label: "877: Latin humor and satire" },
                    { value: "878: Latin miscellaneous writings", label: "878: Latin miscellaneous writings" },
                    { value: "879: Literatures of other Italic languages", label: "879: Literatures of other Italic languages" },
            
              
                ];
                break;
            case "880: Hellenic literatures; classical Greek": 
                subdivisions = [
                    { value: "881: Classical Greek poetry", label: "881: Classical Greek poetry" },
                    { value: "882: Classical Greek dramatic poetry & drama", label: "882: Classical Greek dramatic poetry & drama" },
                    { value: "883: Classical Greek epic poetry and fiction", label: "883: Classical Greek epic poetry and fiction" },
                    { value: "884: Classical Greek lyric poetry", label: "884: Classical Greek lyric poetry" },
                    { value: "885: Classical Greek speeches", label: "885: Classical Greek speeches" },
                    { value: "886: Classical Greek letters", label: "886: Classical Greek letters" },
                    { value: "887: Classical Greek humor and satire", label: "887: Classical Greek humor and satire" },
                    { value: "888: Classical Greek miscellaneous writings", label: "888: Classical Greek miscellaneous writings" },
                    { value: "889: Modern Greek literature", label: "889: Modern Greek literature" },
            
              
                ];
                break;
            case "890: Other literatures": 
                subdivisions = [
                    { value: "881: Classical Greek poetry", label: "881: Classical Greek poetry" },
                    { value: "882: Classical Greek dramatic poetry & drama", label: "882: Classical Greek dramatic poetry & drama" },
                    { value: "883: Classical Greek epic poetry and fiction", label: "883: Classical Greek epic poetry and fiction" },
                    { value: "884: Classical Greek lyric poetry", label: "884: Classical Greek lyric poetry" },
                    { value: "885: Classical Greek speeches", label: "885: Classical Greek speeches" },
                    { value: "886: Classical Greek letters", label: "886: Classical Greek letters" },
                    { value: "887: Classical Greek humor and satire", label: "887: Classical Greek humor and satire" },
                    { value: "888: Classical Greek miscellaneous writings", label: "888: Classical Greek miscellaneous writings" },
                    { value: "889: Modern Greek literature", label: "889: Modern Greek literature" },
            
              
                ];
                break;
            case "900: History & geography":
                subdivisions = [
                    { value: "901: Philosophy and theory of history", label: "901: Philosophy and theory of history" },
                    { value: "902: Miscellany of history", label: "902: Miscellany of history" },
                    { value: "903: Dictionaries & encyclopedias", label: "903: Dictionaries & encyclopedias" },
                    { value: "904: Collected accounts of events", label: "904: Collected accounts of events" },
                    { value: "905: Serial publications of history", label: "905: Serial publications of history" },
                    { value: "906: Organizations & management", label: "906: Organizations & management" },
                    { value: "907: Education, research & related topics", label: "907: Education, research & related topics" },
                    { value: "908: Groups of people", label: "908: Groups of people" },
                    { value: "909: World history", label: "909: World history" },
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "910: Geography & travel":
                subdivisions = [
                    { value: "911: Historical geography", label: "911: Historical geography" },
                    { value: "912: Maps and plans of surface of earth", label: "912: Maps and plans of surface of earth" },
                    { value: "913: Geography of and travel in ancient world", label: "913: Geography of and travel in ancient world" },
                    { value: "914: Geography of and travel in Europe", label: "914: Geography of and travel in Europe" },
                    { value: "915: Geography of and travel in Asia", label: "915: Geography of and travel in Asia" },
                    { value: "916: Geography of and travel in Africa", label: "916: Geography of and travel in Africa" },
                    { value: "917: Geography of & travel in North America", label: "917: Geography of & travel in North America" },
                    { value: "918: Geography of & travel in South America", label: "918: Geography of & travel in South America" },
                    { value: "919: Geography of and travel in other areas", label: "919: Geography of and travel in other areas" },
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "920: Biography, genealogy, insignia":
                subdivisions = [
                    { value: "921: (Optional number)", label: "921: (Optional number)" },
                    { value: "922: (Optional number)", label: "921: (Optional number)" },
                    { value: "923: (Optional number)", label: "921: (Optional number)" },
                    { value: "924: (Optional number)", label: "921: (Optional number)" },
                    { value: "925: (Optional number)", label: "921: (Optional number)" },
                    { value: "926: (Optional number)", label: "921: (Optional number)" },
                    { value: "927: (Optional number)", label: "921: (Optional number)" },
                    { value: "928: (Optional number)", label: "921: (Optional number)" },
                    { value: "929: Genealogy, names & insignia", label: "921: Genealogy, names & insignia" },
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "930: History of ancient world to ca. 499":
                subdivisions = [
                    { value: "931: China to 420", label: "931: China to 420" },
                    { value: "932: Egypt to 640", label: "931: Egypt to 640" },
                    { value: "933: Palestine to 70", label: "931: Palestine to 70" },
                    { value: "934: India to 647", label: "931: India to 647" },
                    { value: "935: Mesopotamia & Iranian Plateau to 637", label: "931: Mesopotamia & Iranian Plateau to 637" },
                    { value: "936: Europe north & west of Italy to ca. 499 ", label: "931: Europe north & west of Italy to ca. 499" },
                    { value: "937: Italy & adjacent territories to 476", label: "931: Italy & adjacent territories to 476" },
                    { value: "938: Greece to 323", label: "931: Greece to 323" },
                    { value: "939: Other parts of ancient world", label: "931: Other parts of ancient world" },
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "940: History of Europe":
                subdivisions = [
                    { value: "941: British Isles", label: "941: British Isles" },
                    { value: "942: England and Wales", label: "942: England and Wales" },
                    { value: "943: Germany and central Europe", label: "943: Germany and central Europe" },
                    { value: "944: France and Monaco", label: "944: France and Monaco" },
                    { value: "945: Italy, San Marino, Vatican City, Malta", label: "945: Italy, San Marino, Vatican City, Malta" },
                    { value: "946: Spain, Andorra, Gibraltar, Portugal", label: "946: Spain, Andorra, Gibraltar, Portugal" },
                    { value: "947: Russia and east Europe", label: "947: Russia and east Europe" },
                    { value: "948: Scandinavia and Finland", label: "948: Scandinavia and Finland" },
                    { value: "949: Other parts of Europe", label: "949: Other parts of Europe" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "950: History of Asia":
                subdivisions = [
                    { value: "951: China and adjacent areas", label: "951: China and adjacent areas" },
                    { value: "952: Japan", label: "952: Japan" },
                    { value: "953: Arabian Peninsula and adjacent areas", label: "953: Arabian Peninsula and adjacent areas" },
                    { value: "954: India & south Asia", label: "954: India & south Asia" },
                    { value: "955: Iran", label: "955: Iran" },
                    { value: "956: Middle East (Near East)", label: "956: Middle East (Near East)" },
                    { value: "957: Siberia (Asiatic Russia)", label: "957: Siberia (Asiatic Russia)" },
                    { value: "958: Central Asia", label: "958: Central Asia" },
                    { value: "959: Southeast Asia", label: "959: Southeast Asia" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "960: History of Africa":
                subdivisions = [
                    { value: "961: Tunisia and Libya", label: "961: Tunisia and Libya" },
                    { value: "962: Egypt, Sudan, South Sudan", label: "962: Egypt, Sudan, South Sudan" },
                    { value: "963: Ethiopia and Eritrea", label: "963: Ethiopia and Eritrea" },
                    { value: "964: Morocco, Ceuta, Melilla, Western Sahara", label: "964: Morocco, Ceuta, Melilla, Western Sahara" },
                    { value: "965: Algeria", label: "965: Algeria" },
                    { value: "966: West Africa and offshore islands", label: "966: West Africa and offshore islands" },
                    { value: "967: Central Africa and offshore islands", label: "967: Central Africa and offshore islands" },
                    { value: "968: South Africa & southern Africa", label: "968: South Africa & southern Africa" },
                    { value: "969: South Indian Ocean islands", label: "969: South Indian Ocean islands" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "970: History of North America":
                subdivisions = [
                    { value: "971: Canada", label: "971: Canada" },
                    { value: "972: Mexico, Central America, West Indies", label: "972: Mexico, Central America, West Indies" },
                    { value: "973: United States", label: "973: United States" },
                    { value: "974: Northeastern United States", label: "974: Northeastern United States" },
                    { value: "975: Southeastern United States", label: "975: Southeastern United States" },
                    { value: "976: South central United States", label: "976: South central United States" },
                    { value: "977: North central United States", label: "977: North central United States" },
                    { value: "978: Western United States", label: "978: Western United States" },
                    { value: "979: Great Basin & Pacific Slope region", label: "979: Great Basin & Pacific Slope region" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "980: History of South America":
                subdivisions = [
                    { value: "981: Brazil", label: "981: Brazil" },
                    { value: "982: Argentina", label: "982: Argentina" },
                    { value: "983: Chile", label: "983: Chile" },
                    { value: "984: Bolivia", label: "984: Bolivia" },
                    { value: "985: Peru", label: "985: Peru" },
                    { value: "986: Colombia and Ecuador", label: "986: Colombia and Ecuador" },
                    { value: "987: Venezuela", label: "987: Venezuela" },
                    { value: "988: Guiana", label: "988: Guiana" },
                    { value: "989: Paraguay and Uruguay", label: "989: Paraguay and Uruguay" }
                    // Add other subdivisions for this subcategory
                ];
                break;
            case "990: History of other areas":
                subdivisions = [
                    { value: "991: [Unassigned]", label: "991: [Unassigned]" },
                    { value: "992: [Unassigned]", label: "992: [Unassigned]" },
                    { value: "993: New Zealand", label: "993: New Zealand" },
                    { value: "994: Australia", label: "994: Australia" },
                    { value: "995: New Guinea & Melanesia", label: "995: New Guinea & Melanesia" },
                    { value: "996: Polynesia & Pacific Ocean islands", label: "996: Polynesia & Pacific Ocean islands" },
                    { value: "997: Atlantic Ocean islands", label: "997: Atlantic Ocean islands" },
                    { value: "998: Arctic islands and Antarctica", label: "998: Arctic islands and Antarctica" },
                    { value: "999: Extraterrestrial worlds", label: "999: Extraterrestrial worlds" }
                    // Add other subdivisions for this subcategory
                ];
                break;








        }

        // Populate the subdivision dropdown with options
        subdivisions.forEach(function(subdivision) {
            subDivisionDropdown.innerHTML += '<option value="' + subdivision.value + '">' + subdivision.label + '</option>';
        });
    }


</script>