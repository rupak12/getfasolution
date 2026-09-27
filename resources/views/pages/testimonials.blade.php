@extends('layouts.app')

@section('title', 'Financial Aid Client Testimonials | FA Solutions')
@section('body_class', '')
@section('current_page', 'testimonials')

@section('main')
<main class="testimonials-page">

        <!-- Page Hero -->
        <!-- <section class="page-hero">
            <div class="page_wrapper">
                <span class="page-hero-label">FA Solutions</span>
                <h1>Our Testimonials</h1>
            </div>
        </section> -->

        @include('pages.partials.inner-banner', ['pageSlug' => 'testimonials'])

        <!-- Testimonials Grid -->
        <section class="testimonials-section">
            <div class="page_wrapper">
                <div class="testimonials-header">
                    <span class="testimonials-label">Testimonials</span>
                    <h2>How We've Helped</h2>
                </div>

                <div class="testimonials-grid">
                    <article class="testimonial-item">
                        <div class="testimonial-logo">
                            <img src="{{ media_asset('images/testimonial-suny-schenectady.png') }}"
                                alt="SUNY Schenectady County Community College">
                        </div>
                        <p class="testimonial-quote">&ldquo;FA Solutions provided Schenectady County Community College
                            with outstanding expertise and resources to navigate us through a heightened period of
                            activity during a period when we were challenged with staffing issues in our Financial Aid
                            Office. Customer support is FA Solutions specialty! Our institutional call for support from
                            FA Solutions was answered quickly. FA Solutions partnered with our campus to provide
                            high-quality service to our student body during this peak period. Thank you, FA
                            Solutions.&rdquo;</p>
                        <p class="testimonial-author">Martha J. Asselin, Ph.D., Vice President of Student Affairs,
                            Schenectady County Community College</p>
                    </article>

                    <article class="testimonial-item">
                        <div class="testimonial-logo">
                            <img src="{{ media_asset('images/testimonial-tcl.png') }}" alt="Technical College of the Lowcountry">
                        </div>
                        <p class="testimonial-quote">&ldquo;The Technical College of the Lowcountry (TCL) is extremely
                            pleased with our partnership with FA Solutions. FA Solutions has provided us with excellent
                            service and quality outcomes. They are client-driven and have worked to find the best
                            solutions for us.&rdquo;</p>
                        <p class="testimonial-author">Nancy Holt Weber, Vice President for Student Services, Technical
                            College of the Lowcountry</p>
                    </article>

                    <article class="testimonial-item">
                        <div class="testimonial-logo">
                            <img src="{{ media_asset('images/testimonial-arizona-christian.png') }}" alt="Arizona Christian University">
                        </div>
                        <p class="testimonial-quote">&ldquo;FA Solutions was recommended by Knowledge Elements to
                            assist with financial aid for our adult program. Their service has been most excellent. They
                            go above and beyond what we ask. They are an organization of integrity. They collaborate
                            very well and offer superb customer service to our students and staff.&rdquo;</p>
                        <p class="testimonial-author">Dr. Jim Ellis, Former Senior Vice President and Dean,
                            Professional, Online &amp; Adult Studies Arizona Christian College</p>
                    </article>

                    <article class="testimonial-item">
                        <div class="testimonial-logo">
                            <img src="{{ media_asset('images/testimonial-vermont-law.png') }}" alt="Vermont Law & Graduate School">
                        </div>
                        <p class="testimonial-quote">&ldquo;Vermont Law School is small mission-driven and
                            student-centered institution. We didn't want to work with a big consulting firm. FA
                            Solutions provided us with the regulatory expertise, policy guidance, and personnel support
                            to see us through a transition period. Rob, Annette, and the rest of their team felt like
                            part of our family; always responsive and focused on student satisfaction.&rdquo;</p>
                        <p class="testimonial-author">John D. Miller Jr., '09, Associate Dean for Enrollment &amp;
                            Marketing, Vermont Law School</p>
                    </article>

                    <article class="testimonial-item">
                        <div class="testimonial-logo">
                            <img src="{{ media_asset('images/testimonial-messenger-college.png') }}" alt="Messenger College">
                        </div>
                        <p class="testimonial-quote">&ldquo;We began our relationship with FA Solutions in 2014 during
                            a major transition in our financial aid office. FA Solutions stepped in and offered a
                            full-service solution, and kept our process running smoothly. The staff has been very
                            professional, knowledgeable, and great to work with. Our financial aid is always processed
                            in a timely manner, and we never have to worry about if it's being handled
                            properly.&rdquo;</p>
                        <p class="testimonial-author">Angela Heppner, Vice President of Business Affairs, Messenger
                            College</p>
                    </article>

                    <article class="testimonial-item">
                        <div class="testimonial-logo">
                            <img src="{{ media_asset('images/testimonial-evangelical-seminary.png') }}" alt="Evangelical Seminary">
                        </div>
                        <p class="testimonial-quote">&ldquo;FA solution's has a knowledgeable and responsive staff that
                            demystifies Title IV regulations. Unique borrower situations are handled with ease and
                            professionalism. Help with any Title IV issues are a phone call or email away. No second
                            guessing what I think is the right answer or doing research. I call the experts at FA
                            Solutions.&rdquo;</p>
                        <p class="testimonial-author">Kevin Henry, Controller &amp; VP for Finance and Operations,
                            Evangelical Congregational Church &amp; Evangelical Theological Seminary</p>
                    </article>

                    <article class="testimonial-item">
                        <div class="testimonial-logo">
                            <img src="{{ media_asset('images/testimonial-dallas-christian.png') }}" alt="Dallas Christian College">
                        </div>
                        <p class="testimonial-quote">&ldquo;I have had nothing but positive results from FA Solutions
                            since the inception this past 2015-2016 school years. They provide timely responses to any
                            inquiries about student files, as well as providing great service to our office.&rdquo;</p>
                        <p class="testimonial-author">Dana Mingo, Director of Financial Aid, Dallas Christian College
                        </p>
                    </article>

                    <article class="testimonial-item">
                        <div class="testimonial-logo">
                            <img src="{{ media_asset('images/testimonial-mountainland.png') }}" alt="Mountainland Technical College">
                        </div>
                        <p class="testimonial-quote">&ldquo;The growing volume of prospective student inquiries and
                            award estimates combined with our limited ability to add new staffing were the two key
                            elements that determined that a Third-Party Servicer was the best solution for our future
                            student needs. FA Solutions offers end-to-end servicing of the financial aid process and is
                            able to ensure that our school meets regulatory and processing requirements. It is exactly
                            the relationship we were in search of. FA Solutions' processors relieving our college of
                            administering the FA award system, by providing the expertise that ensured full governmental
                            compliance, leaving our staff to concentrate on other areas of priority was the best part of
                            our &ldquo;conversion&rdquo; aid year.&rdquo;</p>
                        <p class="testimonial-author">Lisa Hawker, FA Manager, Mountainland Applied Technology College,
                            Lehi, Utah</p>
                    </article>

                    <article class="testimonial-item">
                        <div class="testimonial-logo">
                            <img src="{{ media_asset('images/testimonial-nim.png') }}" alt="National Institute of Massotherapy">
                        </div>
                        <p class="testimonial-quote">&ldquo;We had used the same servicer for about ten years and found
                            that they no longer seemed to fit our needs. Serendipitously, FA Solutions contacted us a
                            couple of years ago and we started doing business with them. I will tell you frankly, I
                            couldn't be happier. Rob, Brenda and their team go out of their way on a daily basis to
                            address any needs we have. No call or email is too petty, no question goes unanswered, and
                            no request goes unfilled.</p>
                        <p class="testimonial-quote">Their online interface is easy to learn and makes document
                            uploading a breeze. I have found that I understand the whole process much better since FA
                            Solutions took over. And the big plus is that our annual audits have been virtually perfect
                            since we started working with them. Again, I couldn't be more pleased with the switch we
                            made.&rdquo;</p>
                        <p class="testimonial-author">Dan Bilich, Director, National Institute of Massotherapy</p>
                    </article>
                </div>

                <div class="testimonials-grid testimonials-grid-last">
                    <article class="testimonial-item">
                        <div class="testimonial-logo">
                            <img src="{{ media_asset('images/testimonial-st-francis.png') }}" alt="St. Francis College">
                        </div>
                        <p class="testimonial-quote">&ldquo;The Student Experience Center team at FA Solutions is an
                            integral part of the Admissions and Financial Aid operation at St. Francis College (SFC).
                            True partners in mission, FA Solutions serves an extension of our teams. Whether answering
                            our main admissions and financial aid lines, entering data into our SIS, or doing what they
                            do best, calling prospective students and developing relationships with Future Terriers,
                            they are in incredible support to our team. FA Solutions has helped lead a resurgence in
                            enrollment.&rdquo;</p>
                        <p class="testimonial-author">Robert Oliva, Director of Recruitment, Office of Admission –
                            St. Francis College</p>
                    </article>

                    <article class="testimonial-item">
                        <div class="testimonial-logo">
                            <img src="{{ media_asset('images/testimonial-st-thomas-aquinas.png') }}" alt="St. Thomas Aquinas College">
                        </div>
                        <p class="testimonial-quote">&ldquo;We reached out to FA Solutions when we had a temporary
                            staffing shortage right as we began our new packaging cycle. For the next number of months,
                            we had an on-call team well versed in all aspects of Financial Aid and who also had strong
                            Banner experience. The consultants was responsive, accurate, and were motivated self
                            starters who were quickly able to assist with everything from alternative loan processing,
                            to packaging, to follow up with our students.</p>
                        <p class="testimonial-quote">Thank you FA Solutions! You helped us through a critical time and
                            I highly recommend your support services!&rdquo;</p>
                        <p class="testimonial-author">Joanne Sullivan M.B.A. Director, Student Financial Services<br>
                            TE/CIC-TE Liaison Officer, St. Thomas Aquinas College</p>
                    </article>
                </div>
            </div>
        </section>

        <!-- Silent Killers -->
        <section class="silent-killers-section">
            <div class="page_wrapper">
                <div class="silent-killers-card">
                    <h2>The Silent Killers of Student Enrollment.</h2>

                    <div class="silent-killers-grid">
                        <div class="silent-killer-item">
                            <div class="silent-killer-icon">
                                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M8 6h32L28 22v9l-4 7-4-7v-9L8 6z" stroke="#00a651" stroke-width="2.2" stroke-linejoin="round"/>
                                    <circle cx="24" cy="16" r="4.2" stroke="#00a651" stroke-width="2"/>
                                    <path d="M24 11.2v1.6M24 19.2v1.6M19.6 16h1.6M26.8 16h1.6M20.6 12.6l1.1 1.1M26.3 18.3l1.1 1.1M26.3 13.7l-1.1 1.1M21.7 18.3l-1.1 1.1" stroke="#00a651" stroke-width="1.6" stroke-linecap="round"/>
                                    <path d="M15 36v7M33 36v7M15 43l-2.6-3.2M15 43l2.6-3.2M33 43l-2.6-3.2M33 43l2.6-3.2" stroke="#00a651" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <h3>The Bottleneck</h3>
                            <p>Processing delays aren't just paperwork—they're lost students.</p>
                        </div>

                        <div class="silent-killer-item">
                            <div class="silent-killer-icon">
                                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M24 6L44 42H4L24 6z" stroke="#00a651" stroke-width="2.4" stroke-linejoin="round"/>
                                    <path d="M24 20v10" stroke="#00a651" stroke-width="2.6" stroke-linecap="round"/>
                                    <circle cx="24" cy="35.5" r="1.8" fill="#00a651"/>
                                </svg>
                            </div>
                            <h3>The Risk</h3>
                            <p>Compliance isn't a “check-the-box” task; it's the foundation of your Title IV eligibility.</p>
                        </div>

                        <div class="silent-killer-item">
                            <div class="silent-killer-icon">
                                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <circle cx="16" cy="14" r="5" stroke="#00a651" stroke-width="2.2"/>
                                    <circle cx="32" cy="14" r="5" stroke="#00a651" stroke-width="2.2"/>
                                    <circle cx="24" cy="18" r="5" stroke="#00a651" stroke-width="2.2"/>
                                    <path d="M7 34c0-6 4-10 9-10 3.2 0 6 1.6 7.6 4" stroke="#00a651" stroke-width="2.2" stroke-linecap="round"/>
                                    <path d="M41 34c0-6-4-10-9-10-3.2 0-6 1.6-7.6 4" stroke="#00a651" stroke-width="2.2" stroke-linecap="round"/>
                                    <path d="M16 32c0-5 3.4-8 8-8s8 3 8 8" stroke="#00a651" stroke-width="2.2" stroke-linecap="round"/>
                                    <path d="M8 40c6 4 26 4 32 0" stroke="#00a651" stroke-width="2.2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <h3>The Burnout</h3>
                            <p>Staffing shortages lead to “institutional memory” loss. We provide the redundancy you lack.</p>
                        </div>
                    </div>

                    <div class="silent-killers-divider"></div>

                    <div class="silent-killers-cta">
                        <a href="{{ route('get-started') }}" class="btn-blue">Get Reliable Financial Aid Support</a>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection

@section('footer')
    @include('layouts.footer', ['type' => 'full'])
@endsection

