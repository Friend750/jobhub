<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
$skills = [
    "Market Research",
    "Branding",
    "Digital Marketing",
    "Search Engine Optimization (SEO)",
    "Search Engine Marketing (SEM)",
    "Social Media Marketing",
    "Content Marketing",
    "Email Marketing",
    "Copywriting",
    "Business Strategy",
    "Economics Fundamentals",
    "Financial Analysis",
    "Budgeting & Forecasting",
    "Project Management",
    "Leadership",
    "Organizational Behavior",
    "Negotiation",
    "Supply Chain Management",
    "Business Process Improvement",
    "Stakeholder Management",
    "E-commerce Platforms",
    "Payment Gateway Integration",
    "Logistics & Fulfillment",
    "Conversion Rate Optimization (CRO)",
    "IT Governance & Policy",
    "IT Service Management (ITSM)",
    "Cloud Infrastructure Management",
    "Vendor Management",
    "Enterprise Resource Planning (ERP)",
    "Business Continuity & Disaster Recovery",
    "Programming Language",
    "Programming Fundamentals (OOP/DataStructure/Clean Code/etc..)",
    "Version Control (Git/GitHub)",
    "HTML/CSS",
    "JavaScript",
    "Front-End Frameworks",
    "Backend Framework",
    "RESTful APIs",
    "Database Design",
    "SQL",
    "NoSQL Databases",
    "iOS Development",
    "Android Development",
    "Cross-Platform Mobile",
    "Push Notifications",
    "Geolocation & Mapping",
    "Mobile Security",
    "App Store Optimization (ASO)",
    "Mobile Analytics",
    "Responsive & Adaptive Layouts",
    "Data Collection & Cleaning",
    "Exploratory Data Analysis (EDA)",
    "Statistical Analysis",
    "Data Visualization",
    "Big Data Technologies",
    "ETL (Extract, Transform, Load)",
    "SQL & NoSQL for Analytics",
    "Predictive Modeling",
    "Data Warehousing",
    "Data Governance & Compliance",
    "Machine Learning (Supervised & Unsupervised)",
    "Deep Learning (Neural Networks)",
    "Natural Language Processing (NLP)",
    "Computer Vision",
    "Reinforcement Learning",
    "Time Series Analysis",
    "Model Deployment (MLOps)",
    "AI Ethics & Responsible AI",
    "Edge AI",
    "AutoML",
    "Network Security",
    "Application Security",
    "Ethical Hacking / Penetration Testing",
    "Encryption Techniques",
    "Identity & Access Management (IAM)",
    "Incident Response & Forensics",
    "Governance, Risk & Compliance (GRC)",
    "Cloud Security",
    "Zero Trust Architecture",
    "Secure Software Development (DevSecOps)",
    "Game Design Principles",
    "Game Engines (Unity, Unreal)",
    "Programming language for game (C#, C++, Scripting)",
    "2D/3D Graphics & Animation",
    "Level Design & World Building",
    "UI/UX",
    "Multiplayer Networking",
    "Audio Design & Implementation",
    "AR/VR Development",
    "Game Monetization",
    "Critical Thinking & Problem-Solving",
    "Communication & Presentation",
    "Collaboration & Teamwork",
    "Creativity & Innovation",
    "Adaptability & Agility",
    "Time Management",
    "Entrepreneurial Mindset",
    "Customer Relationship Management (CRM)",
    "Data-Driven Decision Making",
    "Continuous Learning"
];

        foreach ($skills as $skill) {
            Skill::create(['name' => $skill]);
        }
    }
}
