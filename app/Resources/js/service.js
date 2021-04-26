const base = "https://monefize.com/wp-json/wordpressbase/v1";

export const sendContactForm = async function sendContactForm(fields) {
  const params = Object.entries(fields)
    .map(([key, value]) => `${key}=${value}`)
    .join("&");

  const response = await fetch(`${base}/contact?${params}`)
  const parsed = await response.json();

  return parsed;
};
