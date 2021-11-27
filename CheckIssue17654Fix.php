<?php
/**
 * CheckIssue17654Fix 
 *
 * @author Denis Chenu <denis@sondages.pro>
 * @copyright 2021 Denis Chenu <http://www.sondages.pro>
 * @license MIT
 * @version 0.1.0
 * @see https://github.com/LimeSurvey/LimeSurvey/pull/2087
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
class CheckIssue17654Fix extends PluginBase
{
    protected $storage = 'DbStorage';

    static protected $description = 'Check issue 17654 fix https://github.com/LimeSurvey/LimeSurvey/pull/2087';
    static protected $name = 'CheckIssue17654Fix';

    private $logList = array();

    public function init()
    {
        
        $this->subscribe('beforeQuestionRender');
        $this->subscribe('getPluginTwigPath');
    }
    
    /** See event **/
    public function beforeQuestionRender() {
        $renderEvent = $this->getEvent();
        $this->checkIssueAddEventNameToLog(__FUNCTION__, __LINE__);
        $this->subscribe('beforeHasPermission');
        $havePermission = Permission::model()->hasSurveyPermission($renderEvent->get('surveyId'), 'surveycontent');
        $this->checkIssueAddEventNameToLog(__FUNCTION__, __LINE__);
        $checkTwig = App()->twigRenderer->renderPartial('test.twig', array('havePermission'=>$havePermission));
        $this->checkIssueAddEventNameToLog(__FUNCTION__, __LINE__);
        $newHelp = $renderEvent->get('help');
        $newHelp .= $checkTwig;
        $newHelp .= "<pre>" . print_r($this->logList, 1) . "</pre>";
        $renderEvent->set('help',$newHelp);
    }

    /** See event **/
    public function getPluginTwigPath() {
        $this->checkIssueAddEventNameToLog(__FUNCTION__, __LINE__);
        $viewPath = dirname(__FILE__)."/views";
        $this->getEvent()->append('add', array($viewPath));
        $this->checkIssueAddEventNameToLog(__FUNCTION__, __LINE__);
    }

    /** See event **/
    public function beforeHasPermission() {
        $this->checkIssueAddEventNameToLog(__FUNCTION__, __LINE__);
    }
    
    /**
     * Add the currentEventName with current function and line called in list
     * @param string $functionName
     * @param integer $line
     * @return void
     */
    private function checkIssueAddEventNameToLog($functionName, $line)
    {
        $eventName = $this->getEvent()->getEventName();
        $this->logList[] = "eventName {$eventName} ,  function {$functionName}, line {$line}";
    }
}
