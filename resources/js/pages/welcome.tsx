import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Dashboard Information System">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="flex min-h-screen flex-col items-center bg-gradient-to-br from-blue-50 to-indigo-100 p-6 text-gray-900 lg:justify-center lg:p-8 dark:from-gray-900 dark:to-gray-800 dark:text-white">
                <header className="mb-8 w-full max-w-6xl">
                    <nav className="flex items-center justify-between">
                        <div className="flex items-center space-x-2">
                            <div className="text-2xl">📊</div>
                            <h2 className="text-xl font-semibold">Dashboard IS</h2>
                        </div>
                        <div className="flex items-center gap-4">
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="inline-block rounded-lg bg-blue-600 px-6 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700"
                                >
                                    Go to Dashboard
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="inline-block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400"
                                    >
                                        Log in
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="inline-block rounded-lg bg-blue-600 px-6 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700"
                                    >
                                        Register
                                    </Link>
                                </>
                            )}
                        </div>
                    </nav>
                </header>

                <main className="flex w-full max-w-6xl flex-col items-center text-center">
                    {/* Hero Section */}
                    <div className="mb-16">
                        <h1 className="mb-6 text-4xl font-bold leading-tight md:text-6xl">
                            📊 Dashboard Information System
                        </h1>
                        <p className="mb-8 text-xl text-gray-600 md:text-2xl dark:text-gray-300">
                            Transform your data into actionable insights with interactive dashboards, 
                            dynamic content management, and presentation sharing
                        </p>
                        {!auth.user && (
                            <div className="flex flex-col gap-4 sm:flex-row sm:justify-center">
                                <Link
                                    href={route('register')}
                                    className="inline-block rounded-lg bg-blue-600 px-8 py-3 font-semibold text-white transition-colors hover:bg-blue-700"
                                >
                                    🚀 Get Started Free
                                </Link>
                                <Link
                                    href={route('login')}
                                    className="inline-block rounded-lg border border-gray-300 px-8 py-3 font-semibold text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-800"
                                >
                                    👤 Sign In
                                </Link>
                            </div>
                        )}
                    </div>

                    {/* Features Grid */}
                    <div className="mb-16 grid gap-8 md:grid-cols-3">
                        <div className="rounded-xl bg-white p-6 shadow-lg dark:bg-gray-800">
                            <div className="mb-4 text-4xl">📈</div>
                            <h3 className="mb-2 text-xl font-semibold">Achievement Analytics</h3>
                            <p className="text-gray-600 dark:text-gray-400">
                                Visualize your KPIs with beautiful charts and graphs. 
                                Sync data automatically from OneDrive spreadsheets.
                            </p>
                        </div>
                        
                        <div className="rounded-xl bg-white p-6 shadow-lg dark:bg-gray-800">
                            <div className="mb-4 text-4xl">🎛️</div>
                            <h3 className="mb-2 text-xl font-semibold">Content Management</h3>
                            <p className="text-gray-600 dark:text-gray-400">
                                Create, edit, and schedule dynamic content for your dashboards. 
                                Support for text, images, videos, and announcements.
                            </p>
                        </div>
                        
                        <div className="rounded-xl bg-white p-6 shadow-lg dark:bg-gray-800">
                            <div className="mb-4 text-4xl">🎨</div>
                            <h3 className="mb-2 text-xl font-semibold">Presentation Viewer</h3>
                            <p className="text-gray-600 dark:text-gray-400">
                                Upload PowerPoint presentations and display them as 
                                interactive slides directly in your dashboard.
                            </p>
                        </div>
                    </div>

                    {/* Key Benefits */}
                    <div className="mb-16 rounded-2xl bg-white p-8 shadow-xl dark:bg-gray-800">
                        <h2 className="mb-8 text-3xl font-bold">✨ Why Choose Our Dashboard System?</h2>
                        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                            <div className="flex items-center space-x-3">
                                <div className="text-2xl">🔄</div>
                                <span className="font-medium">Auto-sync with OneDrive</span>
                            </div>
                            <div className="flex items-center space-x-3">
                                <div className="text-2xl">📱</div>
                                <span className="font-medium">Mobile responsive</span>
                            </div>
                            <div className="flex items-center space-x-3">
                                <div className="text-2xl">🎯</div>
                                <span className="font-medium">Real-time updates</span>
                            </div>
                            <div className="flex items-center space-x-3">
                                <div className="text-2xl">🔒</div>
                                <span className="font-medium">Secure & private</span>
                            </div>
                        </div>
                    </div>

                    {/* Demo Showcase */}
                    <div className="mb-16">
                        <h2 className="mb-8 text-3xl font-bold">🖥️ Dashboard Preview</h2>
                        <div className="grid gap-4 md:grid-cols-2">
                            {/* Achievement Card Mock */}
                            <div className="rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 p-6 text-white">
                                <h3 className="mb-2 text-lg font-semibold">Sales Revenue</h3>
                                <div className="text-3xl font-bold">$125,430</div>
                                <div className="text-sm opacity-90">85% of monthly target</div>
                            </div>
                            
                            {/* Content Card Mock */}
                            <div className="rounded-lg bg-gradient-to-r from-green-500 to-teal-600 p-6 text-white">
                                <h3 className="mb-2 text-lg font-semibold">Team Updates</h3>
                                <p className="text-sm opacity-90">
                                    📢 New product launch scheduled for next week. 
                                    All hands meeting at 3 PM.
                                </p>
                            </div>
                        </div>
                    </div>

                    {/* Call to Action */}
                    {!auth.user && (
                        <div className="text-center">
                            <h2 className="mb-4 text-2xl font-bold">Ready to Transform Your Data?</h2>
                            <p className="mb-6 text-gray-600 dark:text-gray-400">
                                Join thousands of teams already using our dashboard system to make better decisions.
                            </p>
                            <Link
                                href={route('register')}
                                className="inline-block rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-3 font-semibold text-white transition-all hover:scale-105 hover:shadow-lg"
                            >
                                🚀 Start Your Free Trial
                            </Link>
                        </div>
                    )}

                    {auth.user && (
                        <div className="text-center">
                            <h2 className="mb-4 text-2xl font-bold">Welcome back, {auth.user.name}!</h2>
                            <p className="mb-6 text-gray-600 dark:text-gray-400">
                                Access your personalized dashboard and start analyzing your data.
                            </p>
                            <Link
                                href={route('dashboard')}
                                className="inline-block rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-3 font-semibold text-white transition-all hover:scale-105 hover:shadow-lg"
                            >
                                📊 Open Dashboard
                            </Link>
                        </div>
                    )}
                </main>

                <footer className="mt-16 text-center text-sm text-gray-500 dark:text-gray-400">
                    <p>
                        Built with ❤️ using Laravel & React • 
                        <a 
                            href="https://app.build" 
                            target="_blank" 
                            className="font-medium text-blue-600 hover:underline dark:text-blue-400"
                        >
                            Powered by app.build
                        </a>
                    </p>
                </footer>
            </div>
        </>
    );
}