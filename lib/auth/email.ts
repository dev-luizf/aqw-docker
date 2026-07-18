import nodemailer from "nodemailer";

type AuthEmail = {
  to: string;
  subject: string;
  text: string;
  url: string;
};

let transport: nodemailer.Transporter | undefined;
const authEnvironment = process.env.APP_ENV ?? "development";

if (authEnvironment === "production" && !process.env.SMTP_HOST) {
  throw new Error("SMTP_HOST is required when APP_ENV=production.");
}

function escapeHtml(value: string) {
  return value
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;");
}

function getTransport() {
  if (transport) return transport;
  if (!process.env.SMTP_HOST) return undefined;

  transport = nodemailer.createTransport({
    host: process.env.SMTP_HOST,
    port: Number(process.env.SMTP_PORT ?? 587),
    secure: process.env.SMTP_SECURE === "true",
    auth: process.env.SMTP_USER
      ? {
          user: process.env.SMTP_USER,
          pass: process.env.SMTP_PASSWORD,
        }
      : undefined,
  });
  return transport;
}

export async function sendAuthEmail(message: AuthEmail) {
  const mailer = getTransport();
  if (!mailer) {
    if (authEnvironment !== "production" && process.env.DEV_LOG_AUTH_LINKS === "true") {
      console.info(`[auth-email] ${message.subject} for ${message.to}: ${message.url}`);
      return;
    }
    throw new Error("SMTP is required for authentication email delivery.");
  }

  await mailer.sendMail({
    from: process.env.MAIL_FROM ?? "Armagedom Worlds <noreply@localhost>",
    to: message.to,
    subject: message.subject,
    text: `${message.text}\n\n${message.url}`,
    html: `<p>${escapeHtml(message.text)}</p><p><a href="${escapeHtml(message.url)}">${escapeHtml(message.url)}</a></p>`,
  });
}
