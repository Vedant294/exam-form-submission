# 🚀 Manual Steps to Deploy Your Project

## Step 1: Create GitHub Repository (2 minutes)

1. Open browser and go to: **https://github.com/new**

2. Fill in the form:
   - **Repository name:** `kdk-college-management`
   - **Description:** `Full-Stack Student Management System - Java Spring Boot + React + MySQL`
   - **Visibility:** ✅ Public
   - **Initialize:** ❌ DO NOT check any boxes
   
3. Click **"Create repository"**

---

## Step 2: Push Code to Your Repository

Open terminal in your project folder and run:

```bash
# Remove old remote
git remote remove origin

# Add your repository
git remote add origin https://github.com/Vedant294/kdk-college-management.git

# Push code
git push -u origin main
```

---

## Step 3: Deploy to GitHub Pages

```bash
# Install gh-pages
cd frontend
npm install --save-dev gh-pages

# Deploy
npm run deploy
```

Wait for deployment to complete (1-2 minutes).

---

## Step 4: Enable GitHub Pages

1. Go to: **https://github.com/Vedant294/kdk-college-management/settings/pages**

2. Under "Source":
   - Select: **Deploy from a branch**
   - Branch: **gh-pages**
   - Folder: **/ (root)**
   
3. Click **Save**

---

## Step 5: Get Your Live Link

Wait 2-3 minutes, then visit:

**https://vedant294.github.io/kdk-college-management**

Test with:
- Email: `jack@gmail.com`
- Password: `201`

---

## ✅ Verification Checklist

- [ ] Repository created on GitHub
- [ ] Code pushed successfully
- [ ] `gh-pages` branch exists
- [ ] GitHub Pages enabled in settings
- [ ] Live link works

---

## 🎯 Your Links

**GitHub Repository:**  
https://github.com/Vedant294/kdk-college-management

**Live Demo:**  
https://vedant294.github.io/kdk-college-management

---

## 📝 Add to Resume/LinkedIn

```
KDK College Management System
Full-Stack Student Management Application

Tech Stack: Java, Spring Boot, React, MySQL
GitHub: https://github.com/Vedant294/kdk-college-management
Live Demo: https://vedant294.github.io/kdk-college-management

• Developed RESTful APIs using Spring Boot
• Built responsive UI with React and Tailwind CSS
• Implemented authentication and profile management
• Deployed to GitHub Pages with CI/CD
```

---

## 🎬 For Interview

**"I've deployed my project to GitHub Pages. You can view the live demo at vedant294.github.io/kdk-college-management. The complete source code is available on my GitHub profile."**

---

## 🆘 Need Help?

If you get stuck at any step, the code is ready. Just:
1. Create the repository on GitHub
2. Run the commands above
3. Enable GitHub Pages

That's it! 🚀
