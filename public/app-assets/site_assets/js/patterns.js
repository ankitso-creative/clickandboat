function containsBlockedContent(message) 
{
    var blockedPatterns = [
        "http", "https", "www.",
        ".com", ".co.uk", ".net", ".org", ".io", ".me", ".biz",
        "linktr.ee", "bit.ly", "tinyurl", "t.me", "wa.me", "calendly.com",
        "zoom.us", "google.com", "facebook.com", "instagram.com",
        "linkedin.com", "tiktok.com", "x.com", "twitter.com",
        "snapchat.com", "onlyfans.com",
        "my instagram", "follow me on instagram", "ig:", "insta handle",
        "my facebook", "fb:", "add me on facebook",
        "my linkedin", "connect with me", "linkedin profile",
        "my tiktok", "snap me", "telegram", "my twitter", "twitter handle",
        "youtube channel", "facebook", "whatsapp me",
        "my phone number is", "call me on", "text me on",
        "my whatsapp is", "message me on whatsapp",
        "dm me", "slide into my dms",
        "email me", "my email is", "contact me at", "reach me at",
        "here’s my number", "use my business card",
        "personal number", "direct line", "my number",
        "my company is", "i work at", "visit my website", "our site is",
        "our brand is", "booking site is", "company details",
        "trading name", "register here", "contact my assistant",
        "here’s my assistant’s number","whatsapp","wp","fb","whatsap","snapchat","[dot]","dot",
        "[at]","[at","at]"
    ];

    // Normalize message to lowercase for case-insensitive matching
    message = message.toLowerCase();

    return blockedPatterns.some(function (pattern) {
        return message.includes(pattern);
    });
}