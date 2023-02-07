# Votes App

This application is inspired by tools like sli.do and lets you create topics that anyone can vote on.

![App screenshot](https://github.com/Ahrengot/votes/blob/media/screenshot.png)

Voting doesn't require a user profile and the flow is very unobtrusive. As the topic author, you control
whether you want anonymous suggestions or not.

### Tech stack

- Laravel /w breeze for authentication
- Inertia.js
- Svelte
- Tailwindcss

### Notes on voting

When users post votes we grab an anonymized browser fingerprint and store it along with the vote. That way we can allow the user to destroy votes after the fact, without requiring that they sign up for an account.

### Contributing

You are more than welcome to submit pull request, issues for new features etc.
