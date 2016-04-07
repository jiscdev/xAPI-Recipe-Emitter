<?php namespace XREmitter\Events;


class AssignmentSubmitted extends Event {
    protected static $verb_display = [
        'en' => 'completed'
    ];

    /**
     * Reads data for an event.
     * @param [String => Mixed] $opts
     * @return [String => Mixed]
     * @override Event
     */
    public function read(array $opts) {


        return array_merge_recursive(parent::read($opts), [
            'verb' => [
                'id' => 'http://adlnet.gov/expapi/verbs/completed',
                'display' => $this->readVerbDisplay($opts),
            ],
            'object' => $this->readActivity($opts),
            'context' => [
                'contextActivities' => [
                    'grouping' => [
                        $this->readCourse($opts),
                    ],
                ],
              'extensions' => [
                    'http://xapi.jisc.ac.uk/extensions/courseArea'=> [
                        'id'=>$opts['course_ext']->url,
                        'http://xapi.jisc.ac.uk/extensions/vle_mod_id'=>$opts['course_ext']->shortname
                       
                    ],
                    
                ],
            ],
        ]);
    }
}